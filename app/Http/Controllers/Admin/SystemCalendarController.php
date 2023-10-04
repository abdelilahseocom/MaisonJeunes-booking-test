<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Province;
use App\Region;
use App\Services\GlobalService;
use App\YouthCenter;
use Illuminate\Support\Facades\Auth;

class SystemCalendarController extends Controller
{
    
    public function index()
    {
        $events = [];
        $user = Auth::user();
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
        $current_youth_center = $regions = $provinces = $youth_centers = [];
        $workplaces = GlobalService::getUserWorkplaces($user);

        if(empty($workplaces['youth_center_id'])) {
            if(empty($workplaces['province_id'])) {
                if(empty($workplaces['region_id'])) {
                    $regions = Region::all()->pluck('name', 'id');
                } else {
                    $provinces = Province::where('region_id', $workplaces['region_id'])->get()->pluck('name', 'id');
                }
            } else {
                $youth_centers =  YouthCenter::whereHas('city', function($query) use($workplaces) {
                    $query->where('province_id', $workplaces['province_id']);
                })->get()->pluck('name', 'id');  
            }
        } else {
            $current_youth_center = $workplaces['youth_center_id'] ? YouthCenter::where('id' ,$workplaces['youth_center_id'])->first() : '';
        }
        return view('admin.calendar.calendar', compact('events', 'current_youth_center', 'regions', 'provinces', 'youth_centers'));
    }
}
