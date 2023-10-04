<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Services\GlobalService;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $bookings = Booking::with(['client'])->get();
        foreach ($bookings as $booking) {
            $color = GlobalService::getEventColor($booking->type);
            if (!$booking->start_time) {
                continue;
            }
            $events[] = [
                'title' => $booking->title,
                'start' => $booking->start_time,
                'end' => $booking->end_time,
                'backgroundColor' => $color,
                'borderColor'  => $color,
                'comment'  => $booking->comment,
                'type'  => $booking->type,
                'url'   => $booking->type == "service" ? route('admin.bookings.edit', $booking->id) : route('admin.edit_unavailability', $booking->id),
            ];
        }
        return view('admin.calendar.calendar', compact('events'));
    }
}
