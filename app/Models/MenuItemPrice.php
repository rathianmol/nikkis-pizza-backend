<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemPrice extends Model
{
        protected $fillable = [
        'menu_item_id',
        'size',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}