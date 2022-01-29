<?php

namespace App\Services;

use App\Filters\Keyword;
use App\Http\Resources\Occupation as OccupationResource;
use App\Http\Resources\OccupationCollection as OccupationResourceCollection;
use App\Models\Occupation;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Validation\Rule;

class OccupationService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = QueryBuilder::for(Occupation::class)
            ->select('occupations.*')
            ->allowedFilters([
                AllowedFilter::exact('name'),
                AllowedFilter::custom(
                    'keyword',
                    Keyword::searchOn([
                        'occupations.name',
                    ])
                )
            ])
            ->defaultSort('name')
            ->allowedSorts(['id', 'name', 'desc']);

        return new OccupationResourceCollection(
            $query->paginate(
                (int) $request->per_page
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        $occupation = Occupation::create($request->all());

        return new OccupationResource($occupation);
    }

    /**
     * Display the specified resource.
     *
     * @param  Occupation $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation): OccupationResource
    {
        return new OccupationResource($occupation);
    }

    public function update(Occupation $occupation, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        $occupation->update($request->all());

        return new OccupationResource($occupation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Occupation $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation)
    {

        $occupation->delete();

        return response()->json();
    }
}
