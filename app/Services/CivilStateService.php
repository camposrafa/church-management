<?php

namespace App\Services;

use App\Models\CivilState;
use App\Filters\Keyword;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CivilStateService
{
    public function index($request)
    {
        $query = QueryBuilder::for(CivilState::class)
            ->allowedFilters([
                AllowedFilter::custom(
                    'filter',
                    Keyword::searchOn(['description'])
                )
            ])
            ->defaultSort('description');

        if (is_null($request->per_page)) {
            return new CivilStateResourceCollection($query->get());
        } else {
            return new CivilStateResourceCollection(
                $query->paginate(
                    (int) $request->per_page
                )
            );
        }
    }

    public function show(int $id): array
    {
        $CivilState = new CivilState();
        return $CivilState->find($id)->toArray();
    }
}
