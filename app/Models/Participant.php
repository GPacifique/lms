<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'date_of_birth'
    ];
    // Marks
    public function marks()
    {
        return $this->hasMany(\App\Models\Mark::class, 'participant_id');
    }

    // ✅ FIXED: Seminar Attendance (correct table)
    public function seminar_attendance()
    {
        return $this->hasMany(\App\Models\SeminarAttendance::class, 'participant_id');
    }

    // Modules
    public function modules()
    {
        return $this->belongsToMany(
            \App\Models\Module::class,
            'module_participants',
            'participant_id',
            'module_id'
        );
    }
}