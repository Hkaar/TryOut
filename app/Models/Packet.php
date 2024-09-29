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
     * @var array<int, string>
     */
    protected $with = ['group', 'subject'];

    /**
     * Define relationship with groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Group, Packet>
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    /**
     * Define relationship with subjects
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Subject, Packet>
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * Define relationship with exams
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Exam>
     */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'packet_id', 'id');
    }

    /**
     * Define relationship with questions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Question>
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'packet_id', 'id');
    }
}
