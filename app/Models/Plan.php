<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'price',
      'type'
    ];

    const TYPE = [
        'monthly' => 'monthly',
        'annual' => 'annual',
    ];

    public function getTypePerUnitAttribute()
    {
        return $this->type == self::TYPE['monthly'] ? 'month' : 'year';
    }
}
