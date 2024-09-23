<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
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
     * Define relationship with users
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User>
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups');
    }

    /**
     * Define relationship with packets
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Packet>
     */
    public function packets()
    {
        return $this->hasMany(Packet::class, 'group_id', 'id');
    }

    /**
     * Define relationship with exams
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Exam>
     */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'group_id', 'id');
    }

    /**
     * Scope a query strictly by the given name
     * 
     * @param \Illuminate\Database\Eloquent\Builder<Group> $query
     * @return \Illuminate\Database\Eloquent\Builder<Group>
     */
    public function scopeStrictByName(Builder $query, string $name)
    {
        return $query->where('name', '=', $name);
    }
}
