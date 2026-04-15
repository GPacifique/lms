<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | ROLE HELPERS
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return $this->hasRole('Admin');
    }

    public function isInstructor(): bool
    {
        return $this->hasRole('Instructor');
    }

    public function isParticipant(): bool
    {
        return $this->hasRole('Participant');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Instructor → Modules
     */
    public function modules()
    {
        return $this->hasMany(Module::class, 'instructor_id');
    }

    /**
     * Instructor → Graded Submissions
     */
    public function gradedSubmissions()
    {
        return $this->hasMany(Submission::class, 'graded_by');
    }

    /**
     * Optional: User → Participant profile
     */
    public function participantProfile()
    {
        return $this->hasOne(Participant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeAdmins($query)
    {
        return $query->role('Admin');
    }

    public function scopeInstructors($query)
    {
        return $query->role('Instructor');
    }

    public function scopeParticipants($query)
    {
        return $query->role('Participant');
    }
}