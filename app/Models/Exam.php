<?php

namespace App\Models;

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
}
