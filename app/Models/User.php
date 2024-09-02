<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'group_id',
        'img',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['role'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Define relationship with roles
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Define relationshipp with groups
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups');
    }

    /**
     * Define relationship with exam results
     */
    public function exam_results()
    {
        return $this->hasMany(ExamResult::class, 'user_id', 'id');
    }

    /**
     * Checks the level of permission a user has
     */
    public function checkPermission(string|array $name)
    {
        if (is_string($name)) {
            return $this->role->name === $name;
        }

        return in_array($this->role->name, $name);
    }
}
