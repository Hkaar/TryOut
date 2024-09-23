<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
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
     * Define relationship with packets
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Packet>
     */
    public function packets()
    {
        return $this->hasMany(Packet::class, 'subject_id', 'id');
    }

    /**
     * Scope a query strictly by the given name
     *
     * @param  \Illuminate\Database\Eloquent\Builder<Subject>  $query
     * @return \Illuminate\Database\Eloquent\Builder<Subject>
     */
    public function scopeStrictByName(Builder $query, string $name)
    {
        return $query->where('name', '=', $name);
    }
}
