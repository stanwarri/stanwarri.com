<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_distribution_id',
        'book_id',
        'name',
        'email',
        'phone',
        'message',
        'how_found',
        'interests',
        'registered_at',
    ];

    protected $casts = [
        'interests' => 'array',
        'registered_at' => 'datetime',
    ];

    public function bookDistribution()
    {
        return $this->belongsTo(BookDistribution::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
