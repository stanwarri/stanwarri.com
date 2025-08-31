<?php

namespace App\Http\Controllers;

use App\Mail\NewCommunityMemberNotification;
use App\Models\BookCounter;
use App\Models\BookDistribution;
use App\Models\CommunityMember;
use App\Services\QrCodeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                'member' => $distribution->communityMember,
            ]);
        }

        return view('community.join', [
            'distribution' => $distribution,
            'book' => $distribution->book,
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

        // Increment books given out counter
        BookCounter::incrementBooksGivenOut();

        // Send notification email
        $adminEmail = config('mail.admin_email', config('mail.from.address'));
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new NewCommunityMemberNotification($member));
        }

        return view('community.success', [
            'member' => $member,
            'book' => $distribution->book,
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

        // Get random inspirational message
        $messages = config('qr-messages.inspirational_messages');
        $inspirationalMessage = $messages[array_rand($messages)];
        
        // Get signature and current date
        $signature = config('qr-messages.signature');
        $generatedDate = now()->format('M j, Y');

        $pdf = Pdf::loadView('qr.pdf-print', [
            'distribution' => $distribution,
            'printData' => $printData,
            'inspirationalMessage' => $inspirationalMessage,
            'signature' => $signature,
            'generatedDate' => $generatedDate,
        ])
        ->setPaper([0, 0, 113.04, 84.96], 'portrait') // 1.57in x 1.18in in points
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => false,
            'defaultFont' => 'Arial',
            'dpi' => 96,
            'fontSubstitution' => false,
            'debugKeepTemp' => false
        ]);

        $filename = 'qr-code-' . $distribution->book->title . '-' . $qrCode . '.pdf';
        
        return $pdf->download($filename);
    }

    public function viewQr(string $qrCode, QrCodeService $qrService)
    {
        $distribution = BookDistribution::where('qr_code', $qrCode)
            ->with('book')
            ->firstOrFail();

        $qrData = $qrService->generatePrintableQrCode($qrCode, [
            'title' => $distribution->book->title,
            'author' => $distribution->book->author,
        ]);

        return view('qr.view', [
            'distribution' => $distribution,
            'qrData' => $qrData,
        ]);
    }
}
