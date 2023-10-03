@extends('layouts.admin')
@section('content')
    @can('youth-center_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @can('youth-center_create')
                    <a class="btn btn-success" href="{{ route('admin.youthCenters.create') }}">
                        {{ trans('global.add') . ' ' . trans('cruds.youth_centers.title_singular') }}
                    </a>
                @endcan

            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') . ' ' . trans('cruds.youth_centers.title_pluriel') }}
        </div>
        <div class="card-body">
            <table class="datatable-youth-centers table table-bordered table-striped table-hover ajaxTable datatable ">
                <thead>

                    <tr>
                        <th width="10"></th>
                        <th>
                            {{ trans('cruds.youth_centers.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.youth_centers.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.youth_centers.fields.address') }}
                        </th>
                        <th>
                            {{ trans('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($youthCenters as $youthCenter)
                        <tr data-entry-id="{{ $youthCenter->id }}">
                            <td></td>
                            <td>
                                {{ $youthCenter->name }}
                            </td>
                            <td>{{ $youthCenter->city->name }}</td>
                            <td>
                                {{ $youthCenter->address }}
                            </td>
                            <td>
                                @can('youth-center_edit')
                                    <a href="{{ route('admin.youthCenters.edit', ['youthCenter' => $youthCenter->id]) }}"
                                        class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('youth-center_delete')
                                    <form class="d-inline"
                                        action="{{ route('admin.youthCenters.destroy', ['youthCenter' => $youthCenter->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-xs btn-danger text-light remove-youth-center"><i
                                                class="far fa-trash-alt"></i></a>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">{{ trans('global.list_empty') }}</td>
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
    <script>
        $(function() {
            $(".datatable-youth-centers").on("click", ".remove-youth-center", async function() {
                await deleteRecordWithconfirmMessage(undefined, undefined, undefined, $(this).parents(
                    'form'));
            })
        });
    </script>
@endsection
