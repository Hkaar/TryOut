<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionChoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_id',
        'content',
        'correct',
    ];

    /**
     * Define relationships with questions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Question, QuestionChoice>
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
