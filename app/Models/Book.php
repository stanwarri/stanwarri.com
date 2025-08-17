<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected function coverImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => is_array($value) ? $value['cover_image_url'] : $value,
        );
    }

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
