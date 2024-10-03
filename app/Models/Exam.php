<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'duration',
        'start_date',
        'end_date',
        'desc',
        'group_id',
        'packet_id',
        'token',
        'public_results',
        'auto_grade',
    ];

    /**
     * Define relationship with packets
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Packet, Exam>
     */
    public function packet()
    {
        return $this->belongsTo(Packet::class, 'packet_id', 'id');
    }

    /**
     * Define relationship with groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Group, Exam>
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    /**
     * Define relationship with exam results
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ExamResult>
     */
    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'exam_id', 'id');
    }

    /**
     * Check if an exam is valid to be worked on
     */
    public function checkValid(): bool
    {
        $current = Carbon::now();

        $startTime = Carbon::parse($this->start_date);
        $endTime = Carbon::parse($this->end_date);

        return $current->greaterThanOrEqualTo($startTime) && $current->lessThanOrEqualTo($endTime);
    }

    /**
     * Check if a user finished the exam
     */
    public function checkFinished(int $userId): ?bool
    {
        $examResult = $this->examResults()->where('user_id', $userId)->first();

        return $examResult !== null ? $examResult->finished : null;
    }
}
