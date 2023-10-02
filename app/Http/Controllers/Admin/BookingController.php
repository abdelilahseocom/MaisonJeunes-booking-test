<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Client;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\BookingRequest;
use App\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Booking::with(['client'])->select(sprintf('%s.*', (new Booking)->table));
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
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
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

        $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $services = Service::all()->pluck('name', 'id');

        return view('admin.bookings.create', compact('clients', 'services'));
    }

    public function store(BookingRequest $request)
    {
        $booking = Booking::create($request->all());

        return redirect()->route('admin.bookings.index');
    }

    public function edit(Booking $booking)
    {
        abort_if(Gate::denies('booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        // $services = Service::all()->pluck('name', 'id');

        $booking->load('client');

        return view('admin.bookings.edit', compact('clients', 'booking'));
    }

    public function update(BookingRequest $request, Booking $booking)
    {
        $booking->update($request->all());
        // $booking->services()->sync($request->input('services', []));

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
}
