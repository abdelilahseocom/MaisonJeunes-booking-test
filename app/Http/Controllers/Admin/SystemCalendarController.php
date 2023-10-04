<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Province;
use App\Region;
use App\Services\GlobalService;
use App\YouthCenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SystemCalendarController extends Controller
{
    
    public function index(Request $request)
    {
        $events = [];
        $user = Auth::user();
        $workplaces = GlobalService::getUserWorkplaces($user);
        $filterData = session('calendar_filter_user_'.Auth::user()->id);
        if(!empty($filterData)) {
            $data['regions'] = Region::all()->pluck('name', 'id');
            $data['provinces'] = Province::where('region_id', $filterData['region_id'])->get()->pluck('name', 'id');
            $data['youth_centers'] =  YouthCenter::whereHas('city', function($query) use($filterData) {
                $query->where('province_id', $filterData['province_id']);
            })->get()->pluck('name', 'id');
        }
        $youth_center_id = !empty($request->youth_center_id) ? $request->youth_center_id  : (!empty($workplaces['youth_center_id']) ? $workplaces['youth_center_id'] : '');
        $bookings = GlobalService::calendarFilter($request, $youth_center_id);
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
        return view('admin.calendar.calendar', compact('events', 'data'));
    }
}
