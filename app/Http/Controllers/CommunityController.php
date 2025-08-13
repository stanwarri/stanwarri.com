<?php

namespace App\Http\Controllers;

use App\Models\BookDistribution;
use App\Models\CommunityMember;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommunityController extends Controller
{
    public function show(string $qrCode)
    {
        $distribution = BookDistribution::where('qr_code', $qrCode)
            ->with(['book', 'communityMember'])
            ->firstOrFail();

        // Check if already registered
        if ($distribution->communityMember) {
            return view('community.already-registered', [
                'distribution' => $distribution,
                'member' => $distribution->communityMember
            ]);
        }

        return view('community.join', [
            'distribution' => $distribution,
            'book' => $distribution->book
        ]);
    }

    public function store(Request $request, string $qrCode)
    {
        $distribution = BookDistribution::where('qr_code', $qrCode)
            ->with(['book', 'communityMember'])
            ->firstOrFail();

        // Check if already registered
        if ($distribution->communityMember) {
            return redirect()->route('community.join', $qrCode)
                ->with('error', 'This book has already been registered.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:community_members,email',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:1000',
            'how_found' => 'nullable|string|max:255',
            'interests' => 'nullable|array',
        ]);

        // Create community member
        $member = CommunityMember::create([
            'book_distribution_id' => $distribution->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
            'how_found' => $validated['how_found'] ?? null,
            'interests' => $validated['interests'] ?? [],
            'registered_at' => now(),
        ]);

        // Update distribution status
        $distribution->update(['status' => 'registered']);

        return view('community.success', [
            'member' => $member,
            'book' => $distribution->book
        ]);
    }

    public function printQr(string $qrCode, QrCodeService $qrService)
    {
        $distribution = BookDistribution::where('qr_code', $qrCode)
            ->with('book')
            ->firstOrFail();

        $printData = $qrService->generatePrintableQrCode($qrCode, [
            'title' => $distribution->book->title,
            'author' => $distribution->book->author,
        ]);

        return view('qr.print', [
            'distribution' => $distribution,
            'printData' => $printData,
        ]);
    }
}
