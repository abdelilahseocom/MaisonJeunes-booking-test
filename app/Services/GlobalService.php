<?php
namespace App\Services;

use App\Booking;
use App\Province;
use App\Region;
use App\YouthCenter;
use Illuminate\Support\Facades\Auth;

class GlobalService{

    public static function getProvincesByRegion($region_id){
        $region = Region::findOrFail($region_id);
        return $region->provinces;
    }

    public static function getCitiesByProvince($province_id){
        $province = Province::findOrFail($province_id);
        return $province->cities;
    }

    public static function getYouthCentersByProvince($province_id){
        $youth_centers = YouthCenter::with('city')->whereHas('city', function($query) use ($province_id) {
            $query->where('province_id', $province_id);
         })->get();
        return $youth_centers;
    }

    public static function getUserWorkplaces($user) {
        $data = [
            'region_id' => '',
            'province_id' => '',
            'youth_center_id' => '',
        ];
        if($user->workplace) {
            $region_id = stripos($user->workplace->model_type, "region") !== false ? $user->workplace->model_id : "";
            $province_id = stripos($user->workplace->model_type, "province") !== false ? $user->workplace->model_id : "";
            $youth_center_id = stripos($user->workplace->model_type, "YouthCenter") !== false ? $user->workplace->model_id : "";
            if(!empty($youth_center_id)) {
                $youth_center = YouthCenter::find($youth_center_id);
                $province_id = $youth_center->city->province->id;
                $region_id = $youth_center->city->province->region->id;
            }else if(!empty($province_id)) {
                $region_id = Province::find($province_id)->region->id;
            }
            $data['region_id'] = $region_id;
            $data['province_id'] = $province_id;
            $data['youth_center_id'] = $youth_center_id;
        }
        return $data;
    }

    public static function getEventColor($type){
        $color = "";
        switch ($type) {
            case 'unavailable':
                $color = "#FF0000";
                break;
            case 'travaux':
                $color = "#D1D100";
                break;
            default:
                $color = "#3a87ad";
            break;
        };
        return $color;
    }

    public static function getYouthCentersProvincesRegionsByUserWorkplace($workplaces) {
        $data = [
           'regions' => [],
           'provinces' => [],
           'youth_centers' => [],
           'current_youth_center' => [],
        ];
        if(empty($workplaces['youth_center_id'])) {
            if(empty($workplaces['province_id'])) {
                if(empty($workplaces['region_id'])) {
                    $data['regions'] = Region::all()->pluck('name', 'id');
                } else {
                    $data['provinces'] = Province::where('region_id', $workplaces['region_id'])->get()->pluck('name', 'id');
                }
            } else {
                    $data['youth_centers']  =  YouthCenter::whereHas('city', function($query) use($workplaces) {
                    $query->where('province_id', $workplaces['province_id']);
                })->get()->pluck('name', 'id');  
            }
        } else {
            $data['current_youth_center'] = $workplaces['youth_center_id'] ? YouthCenter::where('id' ,$workplaces['youth_center_id'])->first() : '';
        }
        return $data;
    }

    public static function calendarFilter($request, $youth_center_id) {
        $user = Auth::user();
        $bookings = Booking::with(['client'])->when($youth_center_id, function ($q) use($youth_center_id) {
            return $q->where('youth_center_id', $youth_center_id);
        })->get();
        session(['calendar_filter_user_'.$user->id => [
            'youth_center_id' => $youth_center_id,
            'province_id'     => $request->province_id,
            'region_id'       => $request->region_id
        ]]);
        return $bookings;
    }
}