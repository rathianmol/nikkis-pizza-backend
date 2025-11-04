<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuItem extends Model
{
protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'image_url',
        'has_sizes',
        'has_addons',
        'is_available',
        'is_special',
        'display_order'
    ];

    protected $casts = [
        'has_sizes' => 'boolean',
        'has_addons' => 'boolean',
        'is_available' => 'boolean',
        'is_special' => 'boolean',
    ];

    protected $with = ['prices', 'addons'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($menuItem) {
            if (empty($menuItem->slug)) {
                $menuItem->slug = Str::slug($menuItem->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    public function prices()
    {
        return $this->hasMany(MenuItemPrice::class)->orderByRaw("
            CASE size
                WHEN 'regular' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'large' THEN 3
                WHEN 'default' THEN 4
            END
        ");
    }

    public function addons()
    {
        return $this->hasMany(MenuItemAddon::class);
    }

    // Helper method to get single price for items without sizes
    public function getSinglePrice()
    {
        if (!$this->has_sizes) {
            return $this->prices()->where('size', 'default')->first()?->price;
        }
        return null;
    }

    // Helper method to check if item has multiple sizes
    public function hasMultipleSizes()
    {
        return $this->has_sizes && $this->prices()->count() > 1;
    }
}
