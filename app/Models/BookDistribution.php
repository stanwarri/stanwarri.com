<?php

namespace App\Models;

use App\Services\QrCodeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'qr_code',
        'distribution_date',
        'distribution_location',
        'notes',
        'status'
    ];

    protected $casts = [
        'distribution_date' => 'date'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function communityMember()
    {
        return $this->hasOne(CommunityMember::class);
    }

    public function getQrImageAttribute()
    {
        if (!$this->qr_code) {
            return null;
        }
        
        $qrService = app(QrCodeService::class);
        return $qrService->generateQrCodeForDistribution($this->qr_code);
    }

    protected static function booted()
    {
        static::creating(function ($distribution) {
            if (empty($distribution->qr_code)) {
                $distribution->qr_code = Str::random(20);
            }
        });
    }
}
