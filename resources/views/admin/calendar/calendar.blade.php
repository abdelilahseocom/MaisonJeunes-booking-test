@extends('layouts.admin')
@section('styles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>
@endsection
@section('content')
<h3 class="page-title">{{ trans('global.systemCalendar') }}</h3>
<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
    </div>
    <div class="card-body">
        <div class="filter mb-3">
            <div class="row">
                @if (empty($current_youth_center))
                @if(!empty($regions))
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                        <label for="region_id">{{ trans("cruds.cities.fields.region_pluriel") }}</label>
                        <select name="region_id" id="region_select" class="form-control select2">
                            <option value=""></option>
                            @forelse($regions as $id => $region)
                            <option value="{{ $id }}" {{ old('region_id') ? 'selected' : '' }}>{{ $region }}</option>
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
                @if(!empty($provinces) || !empty($regions))
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
                        <label for="province_id">{{ trans("cruds.cities.fields.province_pluriel") }}</label>
                        <select name="province_id" id="province_select" class="form-control select2">
                                <option value=""></option>
                                @forelse ($provinces as $id => $province)
                                <option value="{{ $id }}">{{ $province }}</option>
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
                @if(!empty($youth_centers) || !empty($provinces) || !empty($regions))
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('youth_center_id') ? 'has-error' : '' }}">
                        <label for="youth_center_id">{{ trans("cruds.youth_centers.title_singular") }}</label>
                        <select name="youth_center_id" id="youth_center_select" class="form-control select2">
                            <option value=""></option>
                            @forelse ($youth_centers as $id => $youth_center)
                                <option value="{{ $id }}">{{ $youth_center }}</option>
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
                @else
                    <p>{{ $current_youth_center->name }}</p>
                @endif
                
            </div>
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
    })
    </script>
@stop