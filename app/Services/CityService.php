<?php

namespace App\Services;

use App\Models\City;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\CityCollection as CityResourceCollection;
use App\Filters\Keyword;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CityService
{
    public function index($request)
    {
        $query = QueryBuilder::for(City::class)
            ->allowedFilters([
                AllowedFilter::custom(
                    'state_id',
                    Keyword::searchOn(['state_id', 'name'])
                )
            ])
            ->defaultSort('name');

        if (is_null($request->per_page)) {
            return new CityResourceCollection($query->get());
        } else {
            return new CityResourceCollection(
                $query->paginate(
                    (int) $request->per_page
                )
            );
        }
    }

    public function show(int $id): array
    {
        $city = new City();
        return $city->find($id)->toArray();
    }
}
