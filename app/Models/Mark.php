<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\Exam;
use App\Models\Module;  

class Mark extends Model
{
    protected $fillable = [
        'participant_id',
        'module_id',
        'score',
        'total',
    ];

    /**
     * Relationship: Mark belongs to a participant
     */
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * Relationship: Mark belongs to an exam
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
public function module()
{
    return $this->belongsTo(Module::class);
}
    /**
     * Accessor: Calculate percentage
     */
    public function getPercentageAttribute()
    {
        if ($this->total == 0) {
            return 0;
        }

        return ($this->score / $this->total) * 100;
    }

    /**
     * Accessor: Pass/Fail status
     */
    public function getStatusAttribute()
    {
        return $this->percentage >= 50 ? 'Pass' : 'Fail';
    }
}