<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_items',
        'amount',
        'total_price',
        'order_type',
        'payment_method',
        'delivery_address',
        'card_info',
        'status',
    ];

    protected $casts = [
        'cart_items' => 'array', // Cast JSON columns to arrays
        'delivery_address' => 'array', // Cast JSON columns to arrays
        'card_info' => 'array', // Cast JSON columns to arrays
        'total_price' => 'decimal:2',
    ];

    // // Mutator to ensure cart_items is always an array
    // public function setCartItemsAttribute($value)
    // {
    //     $this->attributes['cart_items'] = is_array($value) ? json_encode($value) : $value;
    // }

    // // Accessor to get cart_items as array
    // public function getCartItemsAttribute($value)
    // {
    //     return json_decode($value, true) ?? [];
    // }

    // // Mutator for delivery_address
    // public function setDeliveryAddressAttribute($value)
    // {
    //     $this->attributes['delivery_address'] = $value ? json_encode($value) : null;
    // }

    // // Accessor for delivery_address
    // public function getDeliveryAddressAttribute($value)
    // {
    //     return $value ? json_decode($value, true) : null;
    // }

    // Helper method to check if order is for delivery
    public function isDelivery()
    {
        return $this->order_type === 'delivery';
    }

    // Helper method to check if order is for pickup
    public function isPickup()
    {
        return $this->order_type === 'pickup';
    }

    // Helper method to get formatted total price
    public function getFormattedTotalPriceAttribute()
    {
        return '$' . number_format($this->total_price, 2);
    }

    // Scope to filter by order type
    public function scopeDelivery($query)
    {
        return $query->where('order_type', 'delivery');
    }

    public function scopePickup($query)
    {
        return $query->where('order_type', 'pickup');
    }

    // Scope to filter by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}