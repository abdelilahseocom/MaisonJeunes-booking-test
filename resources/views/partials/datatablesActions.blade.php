@can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        <i class="far fa-eye"></i>
    </a>
@endcan
@can($editGate)
    <a class="btn btn-xs btn-warning" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        <i class="far fa-edit"></i>
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a class="btn btn-xs btn-danger text-light"><i class="far fa-trash-alt"></i></a>
    </form>
@endcan