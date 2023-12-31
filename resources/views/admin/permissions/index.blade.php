@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.permission.title_list') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.permission.fields.id') }}</th>
                        <th>{{ trans('global.name') }}</th>
                        <th>{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $key => $permission)
                        <tr data-entry-id="{{ $permission->id }}">
                            <td>
                                {{ $permission->id ?? '' }}
                            </td>
                            <td>
                                {{ $permission->title ?? '' }}
                            </td>
                            <td>
                                @can('permission_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}">
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endcan

                                @can('permission_edit')
                                    <a class="btn btn-xs btn-warning" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/datatables/datatables.js') }}" type="module"></script>

@endsection