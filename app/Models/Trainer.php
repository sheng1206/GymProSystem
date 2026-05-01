<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'specialization',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignments()
    {
        return $this->hasMany(TrainerAssignment::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'trainer_assignments', 'trainer_id', 'member_id');
    }
}
