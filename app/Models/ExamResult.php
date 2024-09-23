<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'exam_id',
        'user_id',
        'start_date',
        'finish_date',
        'grade',
    ];

    /**
     * Define relationship with exams
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Exam, ExamResult>
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    /**
     * Define relationship with users
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, ExamResult>
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Define relationship with question results
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<QuestionResult>
     */
    public function questionResults()
    {
        return $this->hasMany(QuestionResult::class, 'exam_result_id', 'id');
    }
}
