<?php
namespace App\Services;

use App\Province;
use App\Region;

class GlobalService{

    public static function getProvincesByRegion($region_id){
        $region = Region::findOrFail($region_id);
        return $region->provinces;
    }
    public static function getCitiesByProvince($province_id){
        $province = Province::findOrFail($province_id);
        return $province->cities;
    }
}