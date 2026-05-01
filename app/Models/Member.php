<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Payment;
use App\Models\MembershipPlan;
use App\Models\Trainer;
use App\Models\TrainerAssignment;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'contact',
        'membership_plan_id',
        'join_date',
    ];

    /**
     * One member belongs to one user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * One member belongs to one membership plan
     */
    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    /**
     * One member has many payments
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * One member has many attendance records
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * One member can have many trainer assignments
     */
    public function assignments()
    {
        return $this->hasMany(TrainerAssignment::class);
    }

    /**
     * Get trainers assigned to this member through trainer_assignments table
     */
    public function trainers()
    {
        return $this->hasManyThrough(
            Trainer::class,
            TrainerAssignment::class,
            'member_id',
            'id',
            'id',
            'trainer_id'
        );
    }
}