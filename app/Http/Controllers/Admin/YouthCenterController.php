<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Requests\YouthCenterRequest;
use App\Service;
use App\Services\GlobalService;
use App\YouthCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class YouthCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('youth-center_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = Auth::user();
        $workPlaces = GlobalService::getUserWorkplaces($user);
        if (!empty($workPlaces["region_id"]) && empty($workPlaces["province_id"]) && empty($workPlaces["youth_center_id"])) {
            $youthCenters = YouthCenter::orderBy("updated_at", "asc")->get();
        } else if (!empty($workPlaces["prvince_id"]) && empty($workPlaces["youth_center_id"])) {
            $youthCenters = YouthCenter::whereHas("city", function ($query) use ($workPlaces) {
                $query->where("province_id", $workPlaces["prvince_id"]);
            })->orderBy("updated_at", "asc")->get();
        } else if (!empty($workPlaces["youth_center_id"])) {
            $youthCenters = YouthCenter::where("id", $workPlaces["youth_center_id"])->orderBy("updated_at", "asc")->get();
        } else {
            $youthCenters = YouthCenter::orderBy("updated_at", "asc")->get();
        }

        return view("admin.youthCenters.index", [
            "youthCenters" => $youthCenters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('youth-center_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::where("status", Constants::STATUS_ACTIVE)->get();
        $cities = City::orderBy("name", "asc")->get();
        return view("admin.youthCenters.create", [
            "services" => $services,
            "cities" => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(YouthCenterRequest $request)
    {
        abort_if(Gate::denies('youth-center_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $youthCenterData = [
            "name" => $request->name,
            "address" => $request->address,
            "city_id" => $request->city_id,
            "status" => $request->status,

        ];
        DB::beginTransaction();
        try {
            if ($youthCenter = YouthCenter::create($youthCenterData)) {
                if ($request->has("services") && count($request->services) > 0) {
                    foreach ($request->services as $key => $service) {
                        if (isset($service["is_checked"])) {
                            $serviceData[$service["service_id"]] = [
                                "duration" => $service["duration"],
                                "max_places" => $service["max_places"],
                                "status" => $service["status"],
                            ];
                        }
                    }
                    $youthCenter->services()->sync($serviceData);
                }
                DB::commit();
                Session::flash("success", trans('global.success_msg'));
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash("error", trans('global.error_msg'));
            return redirect()->back();
        }
        return redirect()->route('admin.youthCenters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('youth-center_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $youthCenter = YouthCenter::with("services")->findOrFail($id);
        $services = Service::whereNotIn("id",$youthCenter->services->pluck("id")->toArray())->get();
        $services2 = $youthCenter->services->concat($services);

        $cities = City::orderBy("name", "asc")->get();
        return view("admin.youthCenters.edit", [
            "youthCenter" => $youthCenter,
            "services" => $services2,
            "cities" => $cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(YouthCenterRequest $request, $id)
    {
        abort_if(Gate::denies('youth-center_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $youthCenter = YouthCenter::findOrFail($id);
        $youthCenterData = [
            "name" => $request->name,
            "address" => $request->address,
            "city_id" => $request->city_id,
            "status" => $request->status,


        ];
        DB::beginTransaction();
        try {
            if ($youthCenter->update($youthCenterData)) {
                if ($request->has("services") && count($request->services) > 0) {
                    $serviceData = [];
                    foreach ($request->services as $key => $service) {
                        if (isset($service["is_checked"])) {
                            $serviceData[$service["service_id"]] = [
                                "duration" => $service["duration"],
                                "max_places" => $service["max_places"],
                                "status" => $service["status"],
                            ];
                        }
                    }
                    $youthCenter->services()->sync($serviceData);
                }
                DB::commit();
                Session::flash("success", trans('global.success_msg'));
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash("error", trans('global.error_msg'));
            return redirect()->back();
        }
        return redirect()->route('admin.youthCenters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('youth-center_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $youthCenter = YouthCenter::findOrFail($id);
        DB::beginTransaction();
        try {
            // first thing delete the services associated to this youth center
            $youthCenter->services()->updateExistingPivot($youthCenter->services, ["deleted_at" => now()]);
            // second thing delete the youth center
            $youthCenter->delete();

            DB::commit();
            Session::flash("success", trans('global.success_msg'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash("error", trans('global.error_msg'));
        }

        return redirect()->back();
    }
}
