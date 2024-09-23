<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Define relationship with question results
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<QuestionResult>
     */
    public function results()
    {
        return $this->hasMany(QuestionResult::class, 'status_id', 'id');
    }

    /**
     * Scope a query strictly by the given name
     * 
     * @param \Illuminate\Database\Eloquent\Builder<Status> $query
     * @return \Illuminate\Database\Eloquent\Builder<Status>
     */
    public function scopeStrictByName(Builder $query, string $name)
    {
        return $query->where('name', '=', $name);
    }
}
