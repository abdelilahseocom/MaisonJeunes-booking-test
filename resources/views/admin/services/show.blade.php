@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.service.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.id') }}
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.name') }}
                        </th>
                        <td>
                            {{ $service->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.duration') }}
                        </th>
                        <td>
                            {{ $service->duration }} (minutes)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.max_places') }}
                        </th>
                        <td>
                            {{ $service->duration }} Place(s)
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.title_singular') }}
                        </th>
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
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection