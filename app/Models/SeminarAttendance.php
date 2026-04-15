<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeminarAttendance extends Model
{
    protected $table = 'seminar_attendance';

    protected $fillable = [
        'participant_id',
        'seminar_id',
        'status'
    ];

    // علاقة مع Participant
    public function participant()
    {
        return $this->belongsTo(\App\Models\Participant::class, 'participant_id');
    }

    // (optional) علاقة مع Seminar
    public function seminar()
    {
        return $this->belongsTo(\App\Models\Seminar::class, 'seminar_id');
    }
}