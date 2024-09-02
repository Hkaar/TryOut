<?php

namespace App\Models;

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
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups');
    }

    /**
     * Define relationship with packets
     */
    public function packets()
    {
        return $this->hasMany(Packet::class, 'group_id', 'id');
    }

    /**
     * Define relationship with exams
     */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'group_id', 'id');
    }
}
