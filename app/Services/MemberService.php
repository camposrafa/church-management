<?php

namespace App\Services;

use App\Http\Resources\Member as MemberResource;
use App\Http\Resources\MemberCollection as MemberResourceCollection;
use App\Models\Member;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Filters\Keyword;
use App\Models\MemberOccupation;
use App\Models\Event;
use App\Models\EventMember;
use App\Models\Occupation;
use Spatie\QueryBuilder\AllowedFilter;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MemberService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): MemberResourceCollection
    {

        $query = QueryBuilder::for(Member::class)
            ->select('members.*')
            ->allowedFilters([
                AllowedFilter::exact('name'),
                AllowedFilter::custom(
                    'keyword',
                    Keyword::searchOn([
                        'members.name',
                    ])
                )
            ])
            ->defaultSort('name')
            ->allowedSorts(['id', 'name', 'picture_id', 'occupation_id', 'phone', 'events_id']);

        return new MemberResourceCollection(
            $query->paginate(
                (int) $request->per_page
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Member $member
     * @param Event $event
     * @param Occupation $occupation
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'picture' => 'required|image',
            'phone' => 'required',
            'occupation_id.*' => 'required|exists:' . Occupation::class . ',id',
            'event_id.*' => 'required|exists:' . Event::class . ',id',
            'age' => 'required',
            'cpf' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'number' => 'required',
            'cep' => 'required',
        ]);

        if ($request->has("picture")) {
            $file = new FileService();
            $picture = $file->store($request->file('picture'), 'member', $request->input('name'));
            $request->merge([
                'picture_id' => $picture->id,
            ]);
        }
        $member = Member::create($request->all());

        $occupations = $request->occupation_id;
        $events = $request->event_id;
        $occupations = json_decode($request->occupation_id, true);
        $events = json_decode($request->event_id, true);


        foreach ($occupations as $occupation) {
            $occupationMember = MemberOccupation::where('occupation_id', '=', $occupation)
                ->where('member_id', '=', $member->id)
                ->first();
            if (!is_null($occupationMember)) {
                throw new HttpException(
                    Response::HTTP_CONFLICT,
                    trans('messages.already_exists')
                );
            } else {
                $occupationMember = MemberOccupation::create([
                    'occupation_id' => $occupation,
                    'member_id' => $member->id,
                ]);
            }
        }

        foreach ($events as $event) {
            $eventMember = EventMember::where('event_id', '=',  $event)
                ->where('member_id', '=', $member->id)
                ->first();

            if (!is_null($eventMember)) {
                throw new HttpException(
                    Response::HTTP_CONFLICT,
                    trans('messages.already_exists')
                );
            } else {
                $eventMember = EventMember::create([
                    'event_id' => $event,
                    'member_id' => $member->id,
                ]);
            }
        }

        return new MemberResource($member);
    }

    /**
     * @param string $str
     * @throws HttpException
     * @return MemberResource
     */

    public function show(Member $member): MemberResource
    {
        return new MemberResource($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Member  $Member
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Member $member, Request $request)
    {

        $request->validate([
            'name' => 'required',
            'picture' => 'required|image',
            'phone' => 'required',
            'occupation_id.*' => 'required|exists:' . Occupation::class . ',id',
            'event_id.*' => 'required|exists:' . Event::class . ',id',
        ]);

        if (!is_null($request->picture)) {
            if (!is_null($request->picture)) {
                $file = new FileService();
                $picture = $file->store($request->file('picture'), 'member', $request->input('name'));
                $request->merge([
                    'picture_id' => $picture->id,
                ]);
            }
        } else {
            $request->merge([
                'picture_id' => null
            ]);
        }
        $member->update($request->all());


        return new MemberResource($member);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Member $Member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {

        $member->delete();
        return response()->json();
    }
}
