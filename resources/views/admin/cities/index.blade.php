@extends('layouts.admin')
@section('content')
    @can('client_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @can('city_create')
                <a class="btn btn-success" href="{{ route('admin.cities.create') }}">
                    {{ trans('global.add')." ".trans("cruds.cities.new")." ".trans("cruds.cities.fields.city") }}
                </a>
                @endcan
               
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.cities.fields.cities_list') }}
        </div>
        <div class="card-body">
            <table class="datatable-Permission table table-bordered table-striped table-hover ajaxTable datatable datatable-cities">
                <thead>
                    
                    <tr>
                        <th width="10"></th>
                        <th>
                            {{ trans('cruds.cities.fields.region') }}
                        </th>
                        <th>
                            {{ trans('cruds.cities.fields.province') }}
                        </th>
                        <th>
                            {{ trans('cruds.cities.fields.city') }}
                        </th>
                        <th>
                            {{ trans('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $city)
                        <tr data-entry-id="{{ $city->id }}">
                            <td></td>
                            <td>
                                {{ $city->province->region->name }}
                            </td>
                            <td>
                                {{ $city->province->name }}
                            </td>
                            <td>{{ $city->name }}</td>
                            <td>
                                @can('city_edit')
                                    <a href="{{ route("admin.cities.edit",["city"=>$city->id]) }}" class="btn btn-warning btn-sm" ><i class="fas fa-edit"></i></a>
                                @endcan
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">{{ trans("global.list_empty") }}</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>


        </div>
    </div>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/datatables/datatables.js') }}" type="module"></script>

@endsection
