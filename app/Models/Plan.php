<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','plan_name', 'plan_price', 'plan_details', 'duration', 'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_plans');
    }
    // public function subscriptions()
    // {
        //     return $this->hasMany(Plan::class);
        // }

    }
