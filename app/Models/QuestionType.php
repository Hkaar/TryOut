<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
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
     * Define relationship with question types
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Question>
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'question_type_id', 'id');
    }

    /**
     * Scope a query strictly by the given name
     *
     * @param  \Illuminate\Database\Eloquent\Builder<QuestionType>  $query
     * @return \Illuminate\Database\Eloquent\Builder<QuestionType>
     */
    public function scopeStrictByName(Builder $query, string $name)
    {
        return $query->where('name', '=', $name);
    }
}
