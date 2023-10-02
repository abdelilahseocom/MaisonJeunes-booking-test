<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $bookings = Booking::with(['client'])->get();

        foreach ($bookings as $booking) {
            if (!$booking->start_time) {
                continue;
            }
            $events[] = [
                'title' => $booking->client->name ,
                'start' => $booking->start_time,
                'end' => $booking->end_time,
                'url'   => route('admin.bookings.edit', $booking->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
