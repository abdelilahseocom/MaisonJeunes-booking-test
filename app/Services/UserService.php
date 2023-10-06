<?php
namespace App\Services;

use App\Constants\Constants;
use App\Province;
use App\Region;
use App\User;
use App\UserWorkPlace;
use App\YouthCenter;

class UserService{

    public function saveUserWorkplace($user_id, $request, $update = false){
        $workplace = '';
        $area = '';
        $model_id = '';
        if(!empty($request->youth_center_id)) {
            $model_id = $request->youth_center_id;
            $area = YouthCenter::find($model_id);
        }else if(!empty($request->province_id)) {
            $model_id = $request->province_id;
            $area = Province::find($model_id);
        }else if(!empty($request->region_id)) {
            $model_id = $request->region_id;
            $area = Region::find($model_id);
        }
        if($update == true) {
            UserWorkPlace::where('user_id', $user_id)->delete();
        }
        if(!empty($area)) {
            $workplace = $area->manager()->create([
                'model_id' => $model_id,
                'user_id' => $user_id
            ]);
        }
        return $workplace;
    }
}