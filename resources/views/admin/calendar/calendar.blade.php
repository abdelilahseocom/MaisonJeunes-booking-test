@extends('layouts.admin')
@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>
@endsection
@section('content')
@php
    $filterData = !empty(session('calendar_filter_user_'.Auth::user()->id)) ? session('calendar_filter_user_'.Auth::user()->id) : '';
@endphp
<h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
    </div>
    <div class="card-body">
        <div class="filter mb-3">
            @if (empty($data['current_youth_center']))
            <form action="{{ route('admin.calendar_searching') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            @if(!empty($data['regions']))
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                                    <label for="region_id">{{ trans("cruds.cities.fields.region_pluriel") }}</label>
                                    <select name="region_id" id="region_select" class="form-control select2">
                                        <option value=""></option>
                                        @forelse($data['regions'] as $id => $region)
                                        <option value="{{ $id }}" {{ old('region_id') || !empty($filterData) && $id == $filterData['region_id'] ? 'selected' : '' }}>{{ $region }}</option>
                                        @empty   
                                        @endforelse
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
                            @if(!empty($data['provinces']) || !empty($data['regions']))
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
                                    <label for="province_id">{{ trans("cruds.cities.fields.province_pluriel") }}</label>
                                    <select name="province_id" id="province_select" class="form-control select2">
                                            <option value=""></option>
                                            @forelse($data['provinces'] as $id => $province)
                                            <option value="{{ $id }}" {{ old('province_id') || !empty($filterData) && $id == $filterData['province_id'] ? 'selected' : '' }} >{{ $province }}</option>
                                            @empty   
                                            @endforelse
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
                            @if(!empty($data['youth_centers']) || !empty($data['provinces']) || !empty($data['regions']))
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('youth_center_id') ? 'has-error' : '' }}">
                                    <label for="youth_center_id">{{ trans("cruds.youth_centers.title_singular") }}</label>
                                    <select name="youth_center_id" id="youth_center_select" class="form-control select2">
                                        <option value=""></option>
                                        @forelse ($data['youth_centers'] as $id => $youth_center)
                                            <option value="{{ $id }}" {{ old('youth_center_id') || !empty($filterData) && $id == $filterData['youth_center_id'] ? 'selected' : '' }}>{{ $youth_center }}</option>
                                        @empty 
                                        @endforelse
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
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button class="btn btn-success" type="submit">Rechercher</button>
                    </div>
                </div>
            </form>
            @else
            <div class="col-md-12">
                <div class="row d-flex justify-content-center">
                    <h4 class="youth_center_name">{{ $data['current_youth_center']->name }}</h4>
                </div>
            </div>
            @endif
        </div>
        <div id='calendar'></div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src="{{ asset('js/fullcalendar/fr_lang.js') }}"></script>
    <script>
    $(document).ready(function () {
        // page is now ready, initialize the calendar...
        events ={!! json_encode($events) !!};
        $('#calendar').fullCalendar({
        // put your options and callbacks here
        header: { center: 'year,listYear,month,agendaWeek' }, // buttons for switching between views
        events: events,
        defaultView: 'agendaWeek',
        lang: 'fr'
        })


        // Populate Provinces      
        $(document).on("change","#region_select",function(){
            fillSelectByData("/admin/get-provinces-by-region", this, "province_select");
        })
        // Populate youth centers      
        $(document).on("change","#province_select",function(){
            fillSelectByData("/admin/get-youth-centers-by-province", this, "youth_center_select");
        })
    })
    </script>
@stop