<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'payment_id',
      'type',
      'details',
      'amount',
    ];

    const TYPE = [
        'pay' => 'pay',
        'refund' => 'refund',
        'failed' => 'failed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
