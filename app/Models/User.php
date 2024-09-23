<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
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
     * The default attributes for the model.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'role_id' => 1,
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array<int, string>
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Role, User>
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Define relationshipp with groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Group>
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups');
    }

    /**
     * Define relationship with exam results
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ExamResult>
     */
    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'user_id', 'id');
    }

    /**
     * Checks the level of permission a user has
     *
     * @param  string|array<string>  $names
     */
    public function checkRole(string|array $names): bool
    {
        if (is_string($names)) {
            return $this->role->name === $names;
        }

        return in_array($this->role->name, $names);
    }

    /**
     * Scope a query by a specific group name
     *
     * @param  \Illuminate\Database\Eloquent\Builder<User>  $query
     * @return \Illuminate\Database\Eloquent\Builder<User>
     */
    public function scopeStrictByGroupName(Builder $query, string $name)
    {
        return $query->whereHas('groups', function (Builder $groupQuery) use ($name) {
            $groupQuery->where('name', '=', $name);
        });
    }

    /**
     * Scope a query by a user's role
     *
     * @param  \Illuminate\Database\Eloquent\Builder<User>  $query
     * @return \Illuminate\Database\Eloquent\Builder<User>
     */
    public function scopeStrictByRole(Builder $query, string $role)
    {
        return $query->whereHas('role', function (Builder $roleQuery) use ($role) {
            $roleQuery->where('name', '=', $role);
        });
    }
}
