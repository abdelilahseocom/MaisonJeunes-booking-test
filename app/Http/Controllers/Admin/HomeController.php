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
            $provinces = GlobalService::getProvincesByRegion($request->region_id);
            $reseponse=["error"=>0,"message"=>"","data"=>$provinces];
           
        } catch (Exception $th) {
            $reseponse=["error"=>1,"message"=>$th->getMessage(),"data"=>null];
        }

        return response()->json($reseponse);
    }
    public function getCitiesByProvince(Request $request){

        try {
            $reseponse=[];
            $cities = GlobalService::getCitiesByProvince($request->province_id);
            $reseponse=["error"=>0,"message"=>"","data"=>$cities];
           
        } catch (Exception $th) {
            $reseponse=["error"=>1,"message"=>$th->getMessage(),"data"=>null];
        }

        return response()->json($reseponse);
    }
}
