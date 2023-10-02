<?php

namespace App\Http\Controllers\Admin;

use App\Services\GlobalService;
use Exception;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function getProvincesByRegion(Request $request){
        try {
            $reseponse=[];
            $region_id = !empty($request->data['id']) ? $request->data['id'] : '';
            $provinces = GlobalService::getProvincesByRegion($region_id);
            $reseponse=["error"=>0,"message"=>"","data"=>$provinces];
           
        } catch (Exception $th) {
            $reseponse=["error"=>1,"message"=>$th->getMessage(),"data"=>null];
        }

        return response()->json($reseponse);
    }
    
    public function getCitiesByProvince(Request $request){

        try {
            $reseponse=[];
            $city_id = !empty($request->data['id']) ? $request->data['id'] : '';
            $cities = GlobalService::getCitiesByProvince($city_id);
            $reseponse=["error"=>0,"message"=>"","data"=>$cities];
           
        } catch (Exception $th) {
            $reseponse=["error"=>1,"message"=>$th->getMessage(),"data"=>null];
        }

        return response()->json($reseponse);
    }

    public function getYouthCentersByProvince(Request $request){
        try {
            $reseponse=[];
            $youthcenter_id = !empty($request->data['id']) ? $request->data['id'] : '';
            $youthcenters = GlobalService::getYouthCentersByProvince($youthcenter_id);
            $reseponse=["error"=>0,"message"=>"","data"=>$youthcenters];
           
        } catch (Exception $th) {
            $reseponse=["error"=>1,"message"=>$th->getMessage(),"data"=>null];
        }
        return response()->json($reseponse);
    }
}
