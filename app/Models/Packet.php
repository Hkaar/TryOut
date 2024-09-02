<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'group_id',
        'code',
        'subject_id',
        'desc',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['group', 'subject'];

    /**
     * Define relationship with groups
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    /**
     * Define relationship with subjects
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * Define relationship with exams
     */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'packet_id', 'id');
    }

    /**
     * Define relationship with questions
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'question_id', 'id');
    }
}
