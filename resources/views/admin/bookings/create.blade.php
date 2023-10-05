@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.bookings.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                <label for="client">{{ trans('cruds.booking.fields.client') }}*</label>
                <select name="client_id" id="client" class="form-control select2" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ (isset($booking) && $booking->client ? $booking->client->id : old('client_id')) == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('client_id') }}
                    </em>
                @endif
            </div>
           
            <div class="row">
                @if (empty($workPlaces["region_id"]) )
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                        <label for="region_id">{{ trans("cruds.cities.fields.region_pluriel") }}</label>
                        <select name="region_id" id="region_select" class="form-control select2">
                            <option value=""></option>
                            @foreach($data["regions"] as $key => $region)
                                <option value="{{ $region->id }}" {{ old('region_id') || !empty($workplaces["region_id"]) && in_array($id, [$workplaces["region_id"]]) ? 'selected' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('region_id'))
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
                @if (empty($workPlaces["province_id"]))
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
                        <label for="province_id">{{ trans("cruds.cities.fields.province_pluriel") }}</label>
                        <select name="province_id" id="province_select" class="form-control select2">
                            <option value=""></option>
                            @foreach($data["provinces"] as $id => $province)
                                <option value="{{ $province->id }}" {{ old('province_id') || !empty($workplaces["province_id"]) && in_array($id, [$workplaces["province_id"]]) ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('province_id'))
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
                @if (empty($workPlaces["youth_center_id"]))
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('youth_center_id') ? 'has-error' : '' }}">
                        <label for="youth_center_id">{{ trans("cruds.youth_centers.title_singular") }}</label>
                        <select name="youth_center_id" id="youth_center_select" class="form-control select2">
                            <option value=""></option>
                            @foreach($data["youthCenters"] as $id => $youth_center)
                                <option value="{{ $youth_center->id }}" {{ old('youth_center_id') || !empty($workplaces["youth_center_id"]) && in_array($id, [$workplaces["youth_center_id"]]) ? 'selected' : '' }}>{{ $youth_center->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('youth_center_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('youth_center_id') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.roles_helper') }}
                        </p>
                    </div>
                </div>
                @else
                    <input type="hidden" name="youth_center_id" value="{{ $workPlaces["youth_center_id"] }}" >
                @endif

                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('service_id') ? 'has-error' : '' }}">
                        <label for="service_select">{{ trans("cruds.youth_centers.fields.services.*") }}</label>
                        <select name="service_id" id="service_select" class="form-control select2">
                            <option value=""></option>
                            @foreach($data["youthCentersServices"] as $id => $youthCenterServices)
                           
                                <option value="{{ $youthCenterServices->id }}" >{{ $youthCenterServices->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('service_id'))
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
                <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($booking) ? $booking->start_time : '') }}" required>
                @if($errors->has('start_time'))
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
                <input type="text" id="end_time" name="end_time" class="form-control datetime" value="{{ old('end_time', isset($booking) ? $booking->end_time : '') }}" required>
                @if($errors->has('end_time'))
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
                @if($errors->has('comment'))
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
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    // Populate Provinces      
   
    $(document).on("change","#region_select",function(){
        let emptySelects = [
        "province_select",
        "youth_center_select",
        "service_select",
    ];
        fillSelectByData("/admin/get-provinces-by-region", this, "province_select",null,emptySelects);
    })
    // Populate youth centers      
    $(document).on("change","#province_select",function(){
        let emptySelects = [
        "youth_center_select",
        "service_select",
    ];
        fillSelectByData("/admin/get-youth-centers-by-province", this, "youth_center_select",null,emptySelects);
    })
    $(document).on("change","#youth_center_select",function(){
        let emptySelects = [
        "service_select",
    ];
        fillSelectByData("/admin/get-services-by-youth-center", this, "service_select",null,emptySelects);
    })
</script>
@endsection