@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.permission.show_autorisation') }}
    </div>
    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.permission.fields.id') }}</th>
                        <td>{{ $permission->id }}</td>
                    </tr>
                    <tr>
                        <th>Titre</th>
                        <td>{{ $permission->title }}</td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">{{ trans('global.back_to_list') }}</a>
        </div>
    </div>
</div>
@endsection