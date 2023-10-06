<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Constants\Constants;
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
        $data = [];
        $user = Auth::user();
        $workplaces = GlobalService::getUserWorkplaces($user);
        $filterData = session('calendar_filter_user_'.Auth::user()->id);
        $region_id = $province_id = $youth_center_id = '';

        if(!empty($request->youth_center_id))
            $youth_center_id = $request->youth_center_id;
        if(!empty($workplaces['youth_center_id']))
            $youth_center_id = $workplaces['youth_center_id'];

        if(!empty($request->region_id))
            $region_id = $request->region_id;
        if(!empty($workplaces['region_id']))
            $region_id = $workplaces['region_id'];

        if(!empty($request->province_id))
            $province_id = $request->province_id;
        if(!empty($workplaces['province_id']))
            $province_id = $workplaces['province_id'];
        
        $bookings = GlobalService::calendarFilter($region_id, $province_id, $youth_center_id);
        $data['regions'] = Region::all()->pluck('name', 'id');
        $data['provinces'] = $region_id ? Province::where('region_id', $region_id)->get()->pluck('name', 'id') : [];
        $data['youth_centers'] = $province_id ? YouthCenter::whereHas('city', function($query) use($province_id) {
            $query->where('province_id', $province_id);
        })->get()->pluck('name', 'id') : [];
        $data['current_youth_center'] = $youth_center_id ? YouthCenter::where('id', $youth_center_id)->first() : '';
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
        return view('admin.calendar.calendar', compact('events', 'data', 'workplaces'));
    }
}
