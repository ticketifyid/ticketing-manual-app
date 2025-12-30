<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'location',
        'product_description',
        'event_date',
        'avatar'
    ];

    protected $casts = [
        'event_date' => 'date'
    ];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return Storage::disk('public')->url($this->avatar);
        }
        return null;
    }
}
