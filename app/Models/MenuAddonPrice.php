<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuAddonPrice extends Model
{
    protected $fillable = [
        'addon_id',
        'size',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function addon()
    {
        return $this->belongsTo(MenuItemAddon::class, 'addon_id');
    }
}
