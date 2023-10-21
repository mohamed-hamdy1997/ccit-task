<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    const STATUSES = [
        'active' => 1,
        'disabled' => 2,
    ];

    protected $fillable = [
        'user_id',
        'plan_id',
        'price',
        'status',
        'start',
        'end',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
