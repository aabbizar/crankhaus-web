<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time',
        'party_size',
        'special_requests',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'party_size' => 'integer',
    ];

    /**
     * Scope to only get upcoming reservations.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->toDateString())
                     ->orderBy('date')
                     ->orderBy('time');
    }

    /**
     * Scope to only get pending reservations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
