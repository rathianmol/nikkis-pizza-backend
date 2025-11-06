<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemAddon extends Model
{

    protected $table = 'menu_item_addons';
 protected $fillable = [
        'menu_item_id',
        'addon_name',
        'has_sizes'
    ];

    protected $casts = [
        'has_sizes' => 'boolean',
    ];

    protected $with = ['prices'];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function prices()
    {
        return $this->hasMany(MenuAddonPrice::class, 'addon_id')->orderByRaw("
            CASE size
                WHEN 'regular' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'large' THEN 3
                WHEN 'default' THEN 4
            END
        ");
    }

    // Get single price for addons without sizes
    public function getSinglePrice()
    {
        if (!$this->has_sizes) {
            return $this->prices()->where('size', 'default')->first()?->price;
        }
        return null;
    }
}
