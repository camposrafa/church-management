<?php

namespace App\Services;

use App\Models\State;
use App\Filters\Keyword;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class StateService
{
    public function index(Request $request): array
    {

        $query = QueryBuilder::for(State::class)
            ->allowedFilters([
                AllowedFilter::custom(
                    'keyword',
                    Keyword::searchOn(['code', 'abbreviation', 'name'])
                )
            ])
            ->defaultSort('name')
            ->allowedSorts(['id', 'code', 'abbreviation', 'name']);

        return $query->get()->toArray();
    }

    public function show(int $id): array
    {
        $state = new State();
        return $state->find($id)->toArray();
    }
}
