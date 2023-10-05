@extends('layouts.admin')
@section('content')
    <div class="card">
        <form action="{{ route('admin.bookings.update', ['booking' => $booking->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11">
                        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
                    </div>
                    <div class="col-md-1">
                        <select name="status" class="form-control booking-status">
                            @foreach (Constants::getBookingStatus() as $status)
                            <option {{ $booking->status == $status['value'] ? 'selected' : '' }} value="{{ $status['value'] }}">{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                    <label for="client">{{ trans('cruds.booking.fields.client') }}*</label>
                    <select name="client_id" id="client" class="form-control select2" required>
                        @foreach ($clients as $id => $client)
                            <option value="{{ $id }}"
                                {{ (isset($booking) && $booking->client ? $booking->client->id : old('client_id')) == $id ? 'selected' : '' }}>
                                {{ $client }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('client_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('client_id') }}
                        </em>
                    @endif
                </div>
                @php
                    // dd($workPlaces['youth_center_id']);
                @endphp
                {{-- <div class="row"> --}}
                    @if (empty($workPlaces['youth_center_id']))
                        <div class="row">
                            @if (empty($workPlaces['region_id']))
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                                        <label for="region_id">{{ trans('cruds.cities.fields.region_pluriel') }}<span
                                                class="obligatory">*</span></label>
                                        <select name="region_id" id="region_select" class="form-control select2" required>
                                            <option value=""></option>
                                            @foreach ($regions as $id => $region)
                                                <option value="{{ $id }}"
                                                    {{ old('region_id') || $id == $data['region_selected'] ? 'selected' : '' }}>
                                                    {{ $region }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('region_id'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('region_id') }}
                                            </em>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.user.fields.roles_helper') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if (empty($workPlaces['province_id']))
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
                                        <label for="province_id">{{ trans('cruds.cities.fields.province_pluriel') }}<span
                                                class="obligatory">*</span></label>
                                        <select name="province_id" id="province_select" class="form-control select2"
                                            required>
                                            <option value=""></option>
                                            @forelse($provinces as $id => $province)
                                                <option value="{{ $id }}"
                                                    {{ old('province_id') || $id == $data['province_selected'] ? 'selected' : '' }}>
                                                    {{ $province }}</option>
                                            @empty

                                            @endif
                                        </select>
                                        @if ($errors->has('province_id'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('province_id') }}
                                            </em>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('cruds.user.fields.roles_helper') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('youth_center_id') ? 'has-error' : '' }}">
                                    <label for="youth_center_id">{{ trans('cruds.youth_centers.title_singular') }}<span
                                            class="obligatory">*</span></label>
                                    <select name="youth_center_id" id="youth_center_select" class="form-control select2"
                                        required>
                                        <option value=""></option>
                                        @forelse($youth_centers as $id => $youth_center)
                                            <option value="{{ $youth_center->id }}"
                                                {{  $youth_center->id == $data['youth_center_selected'] ? 'selected' : '' }}>
                                                {{ $youth_center->name }}</option>
                                        @empty
                                        @endif
                                    </select>
                                    @if ($errors->has('youth_center_id'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('youth_center_id') }}
                                        </em>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.user.fields.roles_helper') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                    <input type="hidden" name="youth_center_id" value="{{ $workPlaces["youth_center_id"] }}">

                    @endif

                {{-- </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('service_id') ? 'has-error' : '' }}">
                            <label for="service_select">{{ trans('cruds.youth_centers.fields.services.*') }}</label>
                            <select name="service_id" id="service_select" class="form-control select2">
                                <option value=""></option>
                                @forelse ($services as $id => $service)
                                    <option value="{{ $service->id }}"
                                        {{ $data['service_selected'] == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if ($errors->has('service_id'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('service_id') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.user.fields.roles_helper') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                    <label for="start_time">{{ trans('cruds.booking.fields.start_time') }}*</label>
                    <input type="text" id="start_time" name="start_time" class="form-control datetime"
                        value="{{ old('start_time', isset($booking) ? $booking->start_time : '') }}" required>
                    @if ($errors->has('start_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('start_time') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.booking.fields.start_time_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                    <label for="end_time">{{ trans('cruds.booking.fields.end_time') }}*</label>
                    <input type="text" id="end_time" name="end_time" class="form-control datetime"
                        value="{{ old('end_time', isset($booking) ? $booking->end_time : '') }}" required>
                    @if ($errors->has('end_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('end_time') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.booking.fields.end_time_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                    <label for="comment">{{ trans('cruds.booking.fields.comment') }}</label>
                    <textarea id="comment" name="comment" class="form-control ">{{ old('comment', isset($booking) ? $booking->comment : '') }}</textarea>
                    @if ($errors->has('comment'))
                        <em class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.booking.fields.comments_helper') }}
                    </p>
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        // Populate Provinces      
        
        $(document).on("change", "#region_select", function() {
            let emptySelects = [
            "province_select",
            "youth_center_select",
            "service_select",
        ];
            fillSelectByData("/admin/get-provinces-by-region", this, "province_select", null, emptySelects);
        })
        

        $(document).on("change", "#province_select", function() {
            let emptySelects = [
            "youth_center_select",
            "service_select",
        ];
            fillSelectByData("/admin/get-youth-centers-by-province", this, "youth_center_select", null,emptySelects);
        })
        $(document).on("change", "#youth_center_select", function() {
            let emptySelects = [
            "service_select",
        ];
            fillSelectByData("/admin/get-services-by-youth-center", this, "service_select", null, emptySelects);
        })
    </script>
@endsection
