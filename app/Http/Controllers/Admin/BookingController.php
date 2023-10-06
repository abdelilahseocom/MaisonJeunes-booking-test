<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Client;
use App\Constants\Constants;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\BookingRequest;
use App\Province;
use App\Region;
use App\Service;
use App\Services\BookingService;
use App\Services\GlobalService;
use App\YouthCenter;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Booking::with(['client'])->where("bookings.type",Constants::BOOKING_SERVICE)->select(sprintf('%s.*', (new Booking)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'booking_show';
                $editGate      = 'booking_edit';
                $deleteGate    = 'booking_delete';
                $crudRoutePart = 'bookings';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });
            $table->editColumn('status', function ($row) {
                return trans('global.'.$row->status);
            });
            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });
            // $table->editColumn('services', function ($row) {
            //     $labels = [];

            //     foreach ($row->services as $service) {
            //         $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->name);
            //     }

            //     return implode(' ', $labels);
            // });

            $table->rawColumns(['actions', 'placeholder', 'client', 'services']);

            return $table->make(true);
        }

        return view('admin.bookings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $user = Auth::user();
        $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $workPlaces = GlobalService::getUserWorkplaces($user);


        $data["regions"] =  Region::get();
        $data["provinces"] = !empty($workPlaces["region_id"]) ? Province::where('region_id', $workPlaces['region_id'])->get(): [];
        $data["youthCenters"] = !empty($workPlaces["province_id"]) ? YouthCenter::where("status",Constants::STATUS_ACTIVE)->whereHas('city', function($query) use($workPlaces) {
            $query->where('province_id', $workPlaces['province_id']);
        })->get() : [];
        $data["youthCentersServices"] = !empty($workPlaces["youth_center_id"]) ? YouthCenter::where("status",Constants::STATUS_ACTIVE)->where("id",$workPlaces["youth_center_id"])->first()->services()->wherePivot("status",Constants::STATUS_ACTIVE)->get(): [];

        return view('admin.bookings.create',[
            'clients'=>$clients,
             'workPlaces'=>$workPlaces,
             'data'=>$data,
        ]);
    }

    public function store(BookingRequest $request)
    {
        $YouthCenter= YouthCenter::findOrFail($request->youth_center_id);
        $youthCenterService = $YouthCenter->services->where("id",$request->service_id)->first()->pivot;
        $bookingData=[
            "client_id"=>$request->client_id,
            "start_time"=>$request->start_time,
            "end_time"=>$request->end_time,
            "comment"=>$request->comment,
            "type"=>Constants::BOOKING_SERVICE,
            "youth_center_service_id"=>$youthCenterService->id,
        ];
       
        if (Booking::create($bookingData)) {
            Session::flash("success", trans('global.success_msg'));   
        }
        else{
            Session::flash("error", trans('global.error_msg'));
        }
        return redirect()->route('admin.bookings.index');
    }

    public function edit($booking_id)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $booking = Booking::with("youthCenterService")->findOrFail($booking_id);
        $user = Auth::user();

        $data["region_selected"] = isset($booking) ? $booking->youthCenterService->youthCenter->city->province->region_id : 0;
        $data["province_selected"] = isset($booking) ? $booking->youthCenterService->youthCenter->city->province_id : 0;
        $data["youth_center_selected"] = isset($booking) ? $booking->youthCenterService->youth_center_id : 0;
        $data["service_selected"] = isset($booking) ? $booking->youthCenterService->service_id : 0;

        $workPlaces = GlobalService::getUserWorkplaces($user);

        $regions = Region::all()->pluck('name', 'id');
        $provinces = Province::where('region_id', $data["region_selected"])->get()->pluck('name', 'id');
        $youth_centers =  YouthCenter::whereHas('city', function($query) use($data) {
            $query->where('province_id', $data["province_selected"]);
        })->get();
        $services = YouthCenter::where("id",$data["youth_center_selected"])->first()->services()->wherePivot("status",Constants::STATUS_ACTIVE)->get();

        return view('admin.bookings.edit',[
        'clients'=>$clients,
        'workPlaces'=>$workPlaces,
        'regions'=>$regions,
        'provinces'=>$provinces,
        'youth_centers'=>$youth_centers,
        'services'=>$services,
        'data'=>$data,
        'booking'=>$booking,
        ]);
    }

    public function update(BookingRequest $request, $booking_id)
    {
       $booking = Booking::findOrFail($booking_id);
       $YouthCenter= YouthCenter::findOrFail($request->youth_center_id);
       $youthCenterService = $YouthCenter->services->where("id",$request->service_id)->first()->pivot;
       $bookingData=[
           "client_id"=>$request->client_id,
           "start_time"=>$request->start_time,
           "end_time"=>$request->end_time,
           "comment"=>$request->comment,
           "status"=>$request->status,
           "type"=>Constants::BOOKING_SERVICE,
           "youth_center_service_id"=>$youthCenterService->id,
        ];
      
       if ($booking->update($bookingData)) {
           Session::flash("success", trans('global.success_msg'));   
       }
       else{
           Session::flash("error", trans('global.error_msg'));
       }
       return redirect()->route('admin.bookings.index');

    }

    public function show(Booking $booking)
    {
        abort_if(Gate::denies('booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->load('client');

        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Booking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function createUnavailability(Request $request)
    {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user();
        $workplaces = GlobalService::getUserWorkplaces($user);
        $youth_center_only = $regions = $provinces = $youth_centers = [];
        if(empty($workplaces['youth_center_id'])) {
            if(!empty($workplaces['province_id'])) {
                $youth_centers =  YouthCenter::where("status",Constants::STATUS_ACTIVE)->whereHas('city', function($query) use($workplaces) {
                    $query->where('province_id', $workplaces['province_id']);
                })->get()->pluck('name', 'id');  
            }
            if(empty($workplaces['region_id'])) {
                $regions = Region::all()->pluck('name', 'id');
            }else {
                $provinces = Province::where('region_id', $workplaces['region_id'])->get()->pluck('name', 'id');
            }
        } else {
            $youth_center_only = $workplaces['youth_center_id'] ? YouthCenter::where("status",Constants::STATUS_ACTIVE)->where('id', $workplaces['youth_center_id'])->first() : '';
        }
        return view('admin.bookings.create_unavailability', compact('youth_centers', 'provinces', 'regions', 'workplaces', 'youth_center_only'));
    }

    public function editUnavailability($id)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking = Booking::find($id);
        $user = Auth::user();
        $workplaces = GlobalService::getUserWorkplaces($user);
        $regions = Region::all()->pluck('name', 'id');
        $provinces = Province::where('region_id', $booking->youth_center->city->province->region_id)->get()->pluck('name', 'id');
        $youth_centers =  YouthCenter::whereHas('city', function($query) use($booking) {
            $query->where('province_id', $booking->youth_center->city->province->id);
        })->get()->pluck('name', 'id');

        return view('admin.bookings.edit_unavailability', compact('youth_centers', 'booking', 'workplaces', 'provinces', 'regions'));
    }

    public function saveUnavailability(Request $request, BookingService $bookingservice) {
        abort_if(Gate::denies('booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $request->all();
        $booking_id = !empty($request->booking_id) ? $request->booking_id : '';
        $bookingservice->saveUnavailability($booking_id, $data);

        return redirect()->route('admin.systemCalendar');
    }

    public function destroyUnavailabilityBooking(Booking $booking)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->delete();

        return redirect()->route('admin.systemCalendar');
    }
}
