@extends('layouts.admin')
@section('content')
@can('booking_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.bookings.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.booking.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.booking.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-booking">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.booking.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.booking.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.booking.fields.start_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.booking.fields.end_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.booking.fields.comment') }}
                    </th>
                    <th>
                        {{ trans('global.type') }}
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
        $(".datatable-booking").on( "click", ".btn-danger", async function() {
            await deleteRecordWithconfirmMessage(undefined, undefined, undefined, $(this).parents('form'));
        })
    });
</script>
@endsection