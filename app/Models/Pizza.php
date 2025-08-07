<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image', 
        'description',
        'price_small',
        'price_medium',
        'price_large',
        'price_x_large'
    ];

    /**
     * Without casting
     * $pizza->price_small; // "6.99" (string)
     * 
     * With casting
     * $pizza->price_small; // 6.99 (float with 2 decimal places)
     */
    protected $casts = [
        'price_small' => 'decimal:2',
        'price_medium' => 'decimal:2',
        'price_large' => 'decimal:2',
        'price_x_large' => 'decimal:2',
    ];
}