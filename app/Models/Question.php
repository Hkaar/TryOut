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
     */
    public function packet()
    {
        return $this->belongsTo(Packet::class, 'packet_id', 'id');
    }

    /**
     * Define relationship with question type
     */
    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id', 'id');
    }

    /**
     * Define relationship with question choices
     */
    public function choices()
    {
        return $this->hasMany(QuestionChoice::class, 'question_id', 'id');
    }

    /**
     * Define relationship with question results
     */
    public function results()
    {
        return $this->hasMany(QuestionResult::class, 'question_id', 'id');
    }
}
