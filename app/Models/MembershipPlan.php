<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $fillable = [
        'plan_name',
        'duration_days',
        'price',
    ];

    public function members()
    {
        return $this->hasMany(Member::class, 'membership_plan_id');
    }
}