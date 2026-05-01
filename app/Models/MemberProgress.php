<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberProgress extends Model
{
    protected $table = 'member_progress';

    protected $fillable = [
        'member_id',
        'trainer_id',
        'weight',
        'bmi',
        'notes',
        'progress_date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}