@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.booking.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.id') }}
                        </th>
                        <td>
                            {{ $booking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.client') }}
                        </th>
                        <td>
                            {{ $booking->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.start_time') }}
                        </th>
                        <td>
                            {{ $booking->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.finish_time') }}
                        </th>
                        <td>
                            {{ $booking->finish_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.booking.fields.comments') }}
                        </th>
                        <td>
                            {!! $booking->comments !!}
                        </td>
                    </tr>
                    {{-- <tr>
                        <th>
                            Services
                        </th>
                        <td>
                            @foreach($booking->services as $id => $services)
                                <span class="label label-info label-many">{{ $services->name }}</span>
                            @endforeach
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection