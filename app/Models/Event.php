<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'description',
        'location',
        'is_active',
    ];

    protected $casts = [
        'date'      => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to only get active upcoming events.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('is_active', true)
                     ->where('date', '>=', now())
                     ->orderBy('date');
    }
}
