<?php

namespace App\Services;

use App\Filters\Keyword;
use App\Http\Resources\Church as ChurchResource;
use App\Http\Resources\ChurchCollection as ChurchResourceCollection;
use App\Models\Church;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Validation\Rule;

class ChurchService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = QueryBuilder::for(Church::class)
            ->select('churches.*')
            ->allowedFilters([
                AllowedFilter::exact('name'),
                AllowedFilter::custom(
                    'keyword',
                    Keyword::searchOn([
                        'churchs.name',
                    ])
                )
            ])
            ->defaultSort('name')
            ->allowedSorts(['id', 'name', 'desc']);

        return new ChurchResourceCollection(
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
            'denomination' => 'required',
            'cnpj' => 'required'
        ]);

        $Church = Church::create($request->all());

        return new ChurchResource($Church);
    }

    /**
     * Display the specified resource.
     *
     * @param  Church $Church
     * @return \Illuminate\Http\Response
     */
    public function show(Church $Church): ChurchResource
    {
        return new ChurchResource($Church);
    }

    public function update(Church $Church, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
        ]);

        $Church->update($request->all());

        return new ChurchResource($Church);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Church $Church
     * @return \Illuminate\Http\Response
     */
    public function destroy(Church $Church)
    {

        $Church->delete();

        return response()->json();
    }
}
