<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_id',
        'status_id',
        'exam_result_id',
        'answer',
    ];

    /**
     * Define relationship with questions
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    /**
     * Define relationship with statuses
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    /**
     * Define relationship with exam results
     */
    public function exam_result()
    {
        return $this->belongsTo(ExamResult::class, 'exam_result_id', 'id');
    }
}
