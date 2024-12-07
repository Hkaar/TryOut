<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FilterService
{
    /**
     * Apply search to a query
     *
     * @template TModel of Model
     *
     * @param  \Illuminate\Database\Eloquent\Builder<TModel>  $query
     * @return \Illuminate\Database\Eloquent\Builder<TModel>
     */
    public function search(Builder $query, string $field, string $value, bool $strict = false): Builder
    {
        if (str_contains($field, '.')) {
            [$relationship, $relationField] = explode('.', $field);

            return $query->whereHas($relationship, function ($q) use ($relationField, $value, $strict) {
                if ($strict) {
                    $q->where($relationField, $value);
                } else {
                    $q->where($relationField, 'LIKE', "%{$value}%");
                }
            });
        }

        if ($strict) {
            return $query->where($field, $value);
        }

        return $query->where($field, 'LIKE', "%{$value}%");
    }

    /**
     * Apply a order by date to a query
     *
     * @template TModel of Model
     *
     * @param  \Illuminate\Database\Eloquent\Builder<TModel>  $query
     * @return \Illuminate\Database\Eloquent\Builder<TModel>
     */
    public function order(Builder $query, bool $oldest = false)
    {
        if ($oldest) {
            return $query->oldest();
        }

        return $query->latest();
    }
}
