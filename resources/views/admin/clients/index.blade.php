@extends('layouts.admin')
@section('content')
@can('client_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.clients.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.client.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.client.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-clients">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.client.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.email') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/datatables/datatables.js') }}" type="module"></script>
<script>
    $(function () {
        $(".datatable-clients").on( "click", ".btn-danger", async function() {
            await deleteRecordWithconfirmMessage(undefined, undefined, undefined, $(this).parents('form'));
        })
    });
</script>
@endsection