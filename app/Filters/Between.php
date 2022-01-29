<?php

namespace App\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class Between implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {

        $start = (!empty($value[0])) ? $value[0] : null;
        $end = (!empty($value[1])) ? $value[1] : null;

        if (strpos($start, 'T') || strpos($end, 'T')) {
            $format = "date_format( " . $property . ", '%Y-%m-%dT%H:%i' )";
        } else {
            $format = "date_format( " . $property . ", '%Y-%m-%d' )";
        }

        if (!is_null($start) && !is_null($end)) {
            $query->whereRaw($format . ' between ? and ? ', [$start, $end]);
        } elseif (!is_null($start)) {
            $query->whereRaw($format . '>= ? ', [$start]);
        } elseif (!is_null($end)) {
            $query->whereRaw($format . '<= ? ', [$end]);
        }

        return $query;
    }
}
