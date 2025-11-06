<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuCategory extends Model
{
    protected $table = 'menu_categories';
    protected $fillable = [
        'category_name',
        'slug',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $with = ['menuItems', 'activeMenuItems'];

    // Automatically generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->category_name);
            }
        });
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }

    public function activeMenuItems()
    {
        return $this->hasMany(MenuItem::class, 'category_id')->where('is_available', true);
    }
}
