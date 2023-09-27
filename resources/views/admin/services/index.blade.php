@extends('layouts.admin')
@section('content')
    @can('service_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.services.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.service.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.service.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Permission datatable-Service">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.service.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.actions') }}

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>
                            </td>
                            <td>
                                {{ $service->name }}
                            </td>
                            <td>
                                @can('service_edit')
                                    <a href="{{ route('admin.services.edit', ['service' => $service->id]) }}"
                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('service_show')
                                    <a href="{{ route('admin.services.show', ['service' => $service->id]) }}"
                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('service_delete')
                                    <form class="d-inline" action="{{ route('admin.services.destroy', ['service' => $service->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/datatables/datatables.js') }}" type="module"></script>

@parent
<script></script>
@endsection
