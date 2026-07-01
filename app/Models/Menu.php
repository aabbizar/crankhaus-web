<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'price',
        'description',
        'image_url',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Menu $menu) {
            if (empty($menu->slug)) {
                $menu->slug = Str::slug($menu->name);
            }
        });

        static::updating(function (Menu $menu) {
            if ($menu->isDirty('name')) {
                $menu->slug = Str::slug($menu->name);
            }
        });
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
