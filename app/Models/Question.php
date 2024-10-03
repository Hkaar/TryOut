<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'packet_id',
        'question_type_id',
        'content',
        'img',
    ];

    /**
     * Define relationship with packets
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Packet, Question>
     */
    public function packet()
    {
        return $this->belongsTo(Packet::class, 'packet_id', 'id');
    }

    /**
     * Define relationship with question type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<QuestionType, Question>
     */
    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id', 'id');
    }

    /**
     * Define relationship with question choices
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<QuestionChoice>
     */
    public function choices()
    {
        return $this->hasMany(QuestionChoice::class, 'question_id', 'id');
    }

    /**
     * Define relationship with question results
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<QuestionResult>
     */
    public function results()
    {
        return $this->hasMany(QuestionResult::class, 'question_id', 'id');
    }

    /**
     * Get the right answer of the question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rightAnswer()
    {
        return $this->hasOne(QuestionChoice::class, 'question_id', 'id')->where('correct', 1);
    }
}
