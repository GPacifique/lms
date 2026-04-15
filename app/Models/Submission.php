<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'exam_id',
        'score',
        'graded_by',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function grader()
    {
        return $this->belongsTo(User::class, 'graded_by');
    }
}