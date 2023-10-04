@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.unavailability') }}
    </div>
    <div class="card-body">
        <form action="{{ route('admin.save_unavailability') }}" method="POST">
            @csrf
            @if(empty($workplaces['youth_center_id']))
                <div class="row">
                    @if(empty($workplaces['region_id']))
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                                <label for="region_id">{{ trans("cruds.cities.fields.region_pluriel") }}<span class="obligatory">*</span></label>
                                <select name="region_id" id="region_select" class="form-control select2" required>
                                    <option value=""></option>
                                    @foreach($regions as $id => $region)
                                        <option value="{{ $id }}" {{ old('region_id') || $id == $booking->youth_center->city->province->region->id ? 'selected' : '' }}>{{ $region }}</option>
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
                    @if(empty($workplaces['province_id']))
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
                            <label for="province_id">{{ trans("cruds.cities.fields.province_pluriel") }}<span class="obligatory">*</span></label>
                            <select name="province_id" id="province_select" class="form-control select2" required>
                                <option value=""></option>
                                @forelse($provinces as $id => $province)
                                <option value="{{ $id }}" {{ old('province_id') || $id == $booking->youth_center->city->province->id ? 'selected' : '' }}>{{ $province }}</option>
                                @empty
                                    
                                @endif
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
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('youth_center_id') ? 'has-error' : '' }}">
                            <label for="youth_center_id">{{ trans("cruds.youth_centers.title_singular") }}<span class="obligatory">*</span></label>
                            <select name="youth_center_id" id="youth_center_select" class="form-control select2" required>
                                <option value=""></option>
                                    @forelse($youth_centers as $id => $youth_center)
                                    <option value="{{ $id }}" {{ old('youth_center_id') || $id == $booking->youth_center->id ? 'selected' : '' }}>{{ $youth_center }}</option>
                                    @empty
                                    @endif
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
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                        <label for="start_time">{{ trans('cruds.booking.fields.start_time') }} <span class="obligatory">*</span></label>
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
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                        <label for="end_time">{{ trans('cruds.booking.fields.end_time') }}<span class="obligatory">*</span></label>
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                        <label for="comment">{{ trans('cruds.booking.fields.comment') }}</label>
                        <textarea id="comment" name="comment" class="form-control" rows="1">{{ old('comment', isset($booking) ? $booking->comment : '') }}</textarea>
                        @if($errors->has('comment'))
                            <em class="invalid-feedback">
                                {{ $errors->first('comment') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.booking.fields.comment_helper') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label for="type">{{ trans('global.reason') }}<span class="text-danger">* </span></label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Veuillez sélectionner une option</option>
                            @foreach (Constants::getBookingTypes() as $type)
                                <option value="{{ $type['value'] }}" {{ $type['value'] == $booking->type ? 'selected' : ''  }}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('type'))
                            <em class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </em>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-danger delete-booking mr-2">{{ trans('global.delete') }}</a>
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
        @can('booking_delete')
        <form action="{{ route('admin.delete_unavailability', $booking->id) }}" method="POST" id="delete-booking-form" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
        @endcan
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    // Populate Provinces      
    $(document).on("change","#region_select",function(){
        fillSelectByData("/admin/get-provinces-by-region", this, "province_select");
    })
    // Populate youth centers      
    $(document).on("change","#province_select",function(){
        fillSelectByData("/admin/get-youth-centers-by-province", this, "youth_center_select");
    })
    // delete booking
    $('.delete-booking').on('click', function(){
        $('#delete-booking-form').submit();
    });
</script>
@endsection