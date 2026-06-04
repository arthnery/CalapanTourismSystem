<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourismSpot;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tourism_spot_id' => 'required|exists:tourism_spots,id',
            'booking_date' => 'required|date|after:today',
        ]);

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'tourism_spot_id' => $request->tourism_spot_id,
            'booking_date' => $request->booking_date,
            'status' => 'pending',
        ]);

        $spotName = TourismSpot::find($request->tourism_spot_id)->name;
        ActivityLog::log('Booking Created', "Booked spot: {$spotName} for {$request->booking_date}");

        return back()->with('success', 'Booking submitted successfully!');
    }

    public function index()
    {
        $bookings = auth()->user()->bookings()->with('tourismSpot')->latest()->get();
        return view('user.bookings', compact('bookings'));
    }

    /**
     * Display all bookings for the admin.
     */
    public function adminIndex()
    {
        $bookings = Booking::with(['user', 'tourismSpot'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Cancel a booking (Update status to cancelled).
     */
    public function destroy(Booking $booking)
    {
        // Authorization: Admin can cancel any booking, User can only cancel their own
        if (auth()->user()->role !== 'admin' && $booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update status instead of deleting to keep a record
        $booking->update(['status' => 'cancelled']);

        $spotName = $booking->tourismSpot->name;
        ActivityLog::log('Booking Cancelled', "Cancelled booking for: {$spotName}");

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
