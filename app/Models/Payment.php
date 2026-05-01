<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'member_id',
        'membership_plan_id',
        'amount',
        'payment_date',
        'expiration_date',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'expiration_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function membershipPlan()
    {
        return $this->belongsTo(\App\Models\MembershipPlan::class);
    }
}