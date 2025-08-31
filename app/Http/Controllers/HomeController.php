<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCounter;
use App\Models\BookDistribution;
use App\Models\CommunityMember;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'books_given' => BookDistribution::where('status', '!=', 'pending')->count(),
            'community_members' => CommunityMember::count(),
            'books_available' => Book::sum('quantity_purchased'),
        ];

        $recentBooks = Book::with(['distributions' => function ($query) {
            $query->where('status', '!=', 'pending');
        }])
            ->whereHas('distributions', function ($query) {
                $query->where('status', '!=', 'pending');
            })
            ->latest('created_at')
            ->take(6)
            ->get();

        return view('home.index', compact('stats', 'recentBooks'));
    }

    public function books()
    {
        $books = Book::with(['distributions' => function ($query) {
            $query->where('status', '!=', 'pending');
        }])
            ->latest('created_at')
            ->paginate(12);

        $booksGivenOutCount = BookCounter::getBooksGivenOutCount();

        return view('home.books', compact('books', 'booksGivenOutCount'));
    }
}
