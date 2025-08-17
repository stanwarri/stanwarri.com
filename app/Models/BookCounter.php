<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCounter extends Model
{
    protected $fillable = [
        'counter_type',
        'count',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'count' => 'integer',
        ];
    }

    public static function getBooksGivenOutCount(): int
    {
        return static::where('counter_type', 'books_given_out')->value('count') ?? 0;
    }

    public static function incrementBooksGivenOut(): void
    {
        static::updateOrCreate(
            ['counter_type' => 'books_given_out'],
            ['count' => \DB::raw('count + 1')]
        );
    }

    public static function setBooksGivenOutCount(int $count): void
    {
        static::updateOrCreate(
            ['counter_type' => 'books_given_out'],
            ['count' => $count, 'description' => 'Total books given out to community members']
        );
    }
}
