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
            <table
                class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Permission datatable-Service">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.service.fields.duration') }} (minutes)
                        </th>
                        <th>
                            {{ trans('cruds.service.fields.max_places') }}
                        </th>
                        <th>
                            {{ trans('cruds.service.fields.status') }}
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
                                {{ $service->name }}
                            </td>
                            <td>
                                {{ $service->duration }} (minutes)
                            </td>
                            <td>
                                {{ $service->max_places }} Place(s)
                            </td>
                            <td>
                                @switch($service->status)
                                    @case(Constants::STATUS_ACTIVE)
                                        <span class="badge badge-success">
                                            {{ trans('global.status_active') }}
                                        </span>
                                    @break
                                    @case(Constants::STATUS_NOT_ACTIVE)
                                        <span class="badge badge-danger">
                                            {{ trans('global.status_desactive') }}
                                        </span>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                @can('service_edit')
                                    <a href="{{ route('admin.services.edit', ['service' => $service->id]) }}"
                                        class="btn btn-warning btn-xs"><i class="far fa-edit"></i>
                                    </a>
                                @endcan
                                @can('service_show')
                                    <a href="{{ route('admin.services.show', ['service' => $service->id]) }}"
                                        class="btn btn-info btn-xs"><i class="fas fa-eye"></i> </a>
                                @endcan
                                @can('service_delete')
                                    {{-- <form class="d-inline"
                                        action="{{ route('admin.services.destroy', ['service' => $service->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-xs btn-danger text-light"><i class="far fa-trash-alt"></i></a>
                                    </form> --}}
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
    <script>
        $(function() {
            $(".datatable-Service").on("click", ".btn-danger", async function() {
                await deleteRecordWithconfirmMessage(undefined, undefined, undefined, $(this).parents(
                    'form'));
            })
        });
    </script>
@endsection
