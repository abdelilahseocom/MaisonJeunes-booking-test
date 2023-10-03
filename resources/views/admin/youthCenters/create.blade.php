@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.youthCenters.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ trans('cruds.youth_centers.fields.name') }} <span
                                        class="text-danger">*
                                    </span></label>
                                <input id="name" type="text" class="form-control" name="name">
                                @if ($errors->has('name'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="adress">{{ trans('cruds.youth_centers.fields.address') }} <span
                                        class="text-danger">* </span></label>
                                <input id="adress" type="text" class="form-control" name="address">
                                @if ($errors->has('address'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                                <label for="city_id">{{ trans('cruds.cities.fields.city') }} <span class="text-danger">*
                                    </span>
                                </label>
                                <select name="city_id" id="city_id" class="form-control select2" required>
                                    @forelse ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @empty
                                        <option>{{ trans('global.list_empty') }}</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('city_id'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('city_id') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row " style="max-height: 700px; overflow-y: auto;">

                        <table class="table youth_center_services_table">
                            <thead>
                                <th>
                                    <td>{{ trans('cruds.youth_centers.fields.services.name') }}</td>
                                    <td>{{ trans('cruds.youth_centers.fields.services.duration') }}</td>
                                    <td>{{ trans('cruds.youth_centers.fields.services.max_places') }}</td>
                                    <td>{{ trans('cruds.youth_centers.fields.services.status') }}</td>
                                </th>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($services as $service)
                                    @php
                                        $is_pivot = false;
                                        $index++;
                                        $is_pivot = isset($service->pivot) ? $service->pivot : false;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="hidden" value="{{ $service->id }}"
                                                name="services[{{ $index }}][service_id]">
                                            <input type="checkbox" data-service_id="{{ $service->id }}"
                                                class="form-control checkbox_service checkbox_service_{{ $service->id }}"
                                                value="true" style="height: 23px;"
                                                name="services[{{ $index }}][is_checked]"
                                                {{ $is_pivot ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span>{{ $service->name }}</span>
                                        </td>
                                        <td>
                                            <span class="display_{{ $service->id }}">
                                                <input type="number" class="form-control"
                                                    value="{{ $is_pivot ? $service->pivot->duration : '0' }}"
                                                    name="services[{{ $index }}][duration]">
                                            </span>
                                        </td>
                                        <td>
                                            <span class="display_{{ $service->id }}">

                                                <input type="number" class="form-control"
                                                    value="{{ $is_pivot ? $service->pivot->max_places : '0' }}"
                                                    name="services[{{ $index }}][max_places]">
                                            </span>
                                        </td>
                                        <td>
                                            <span class="display_{{ $service->id }}">

                                                <select name="services[{{ $index }}][status]"
                                                    class="form-control select2 service status_select_{{ $index }} ">
                                                    @foreach (Constants::getAllStatus() as $status)
                                                        <option
                                                            {{ $is_pivot ? ($service->pivot->status == $status['value'] ? 'selected' : '') : '' }}
                                                            value="{{ $status['value'] }}">{{ $status['name'] }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr></tr>
                            </tbody>
                            </thead>
                        </table>

                </div>
                <div class="my-4">
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>


        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.youthCenters.services.script_service')
@endsection
