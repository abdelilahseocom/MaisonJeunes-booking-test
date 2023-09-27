@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
    </div>
    <div class="card-body">
        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.role.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($role) ? $role->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                <label for="permissions">{{ trans('cruds.role.fields.permissions') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span>
                </label>
                @if($errors->has('permissions'))
                    <em class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.permissions_helper') }}
                </p>
            </div>
            <div class="permissions">
                @forelse ($permissionGroups as $key => $group)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>{{ trans('global.permission_manage.'.$key) }}</h5>
                        </div>
                        @forelse ($group as $permission)
                            <div class="col-md-3 mb-2">
                                <div class="form-check">
                                    <input
                                        class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->id }}"
                                        id="permission_{{ $permission->id }}" {{ (in_array($permission->id, old('permissions', [])) || isset($role) && $role->permissions->contains($permission->id)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ $permission->title }}
                                    </label>
                                </div>
                            </div>
                        @empty
                            <p>{{ trans('global.list_empty') }}</p>
                        @endforelse
                    </div>
                @empty
                    <p>{{ trans('global.list_empty') }}</p>
                @endforelse
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection