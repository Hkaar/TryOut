<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    /**
     * Apply search to a query
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $field
     * @param string $value
     * @param bool $strict
     * @return \Illuminate\Database\Eloquent\Builder
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
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $oldest
     * @return Builder
     */
    public function order(Builder $query, bool $oldest = false) 
    {
        if ($oldest) {
            return $query->oldest();
        }

        return $query->latest();
    }
}
