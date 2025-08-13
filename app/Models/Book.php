<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author', 
        'isbn',
        'description',
        'cover_image_url',
        'purchase_date',
        'purchase_price',
        'quantity_purchased'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'purchase_price' => 'decimal:2'
    ];

    public function distributions()
    {
        return $this->hasMany(BookDistribution::class);
    }

    public function communityMembers()
    {
        return $this->hasManyThrough(CommunityMember::class, BookDistribution::class);
    }

    public function getRemainingQuantityAttribute()
    {
        return $this->quantity_purchased - $this->distributions()->count();
    }
}
