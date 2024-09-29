<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Question, QuestionResult>
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    /**
     * Define relationship with statuses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Status, QuestionResult>
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    /**
     * Define relationship with exam results
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<ExamResult, QuestionResult>
     */
    public function examResult()
    {
        return $this->belongsTo(ExamResult::class, 'exam_result_id', 'id');
    }

    /**
     * Scope a query by an exam result id
     *
     * @param  \Illuminate\Database\Eloquent\Builder<QuestionResult>  $query
     * @return \Illuminate\Database\Eloquent\Builder<QuestionResult>
     */
    public function scopeByExamResultId(Builder $query, int $id)
    {
        return $query->where('exam_result_id', '=', $id);
    }
}
