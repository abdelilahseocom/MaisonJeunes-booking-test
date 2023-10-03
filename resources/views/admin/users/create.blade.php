@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Créer un utilisateur
    </div>

    <div class="card-body">
        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                <label for="lastname">{{ trans("cruds.user.fields.lastname") }}<span class="obligatory">*</span></label>
                <input type="text" id="lastname" name="lastname" class="form-control" value="{{ old('lastname', isset($user) ? $user->lastname : '') }}" required>
                @if($errors->has('lastname'))
                    <em class="invalid-feedback">
                        {{ $errors->first('lastname') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                <label for="firstname">{{ trans("cruds.user.fields.firstname") }}<span class="obligatory">*</span></label>
                <input type="text" id="firstname" name="firstname" class="form-control" value="{{ old('firstname', isset($user) ? $user->firstname : '') }}" required>
                @if($errors->has('firstname'))
                    <em class="invalid-feedback">
                        {{ $errors->first('firstname') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans("cruds.user.fields.email") }}<span class="obligatory">*</span></label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans("cruds.user.fields.password") }}</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @if($errors->has('password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.password_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">{{ trans("cruds.user.fields.roles") }}<span class="obligatory">*</span></label>
                <select name="roles[]" id="roles" class="form-control" required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <em class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.roles_helper') }}
                </p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                        <label for="region_id">{{ trans("cruds.cities.fields.region_pluriel") }}</label>
                        <select name="region_id" id="region_select" class="form-control select2">
                            <option value=""></option>
                            @foreach($regions as $id => $region)
                                <option value="{{ $id }}" {{ old('region_id') ? 'selected' : '' }}>{{ $region }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('region_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('region_id') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.roles_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
                        <label for="province_id">{{ trans("cruds.cities.fields.province_pluriel") }}</label>
                        <select name="province_id" id="province_select" class="form-control select2">
                                <option value=""></option>
                        </select>
                        @if($errors->has('province_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('province_id') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.roles_helper') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('youth_center_id') ? 'has-error' : '' }}">
                        <label for="youth_center_id">{{ trans("cruds.youth_centers.title_singular") }}</label>
                        <select name="youth_center_id" id="youth_center_select" class="form-control select2">
                            <option value=""></option>
                        </select>
                        @if($errors->has('youth_center_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('youth_center_id') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('cruds.user.fields.roles_helper') }}
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    // Populate Provinces      
    $(document).on("change","#region_select",function(){
        fillSelectByData("/admin/get-provinces-by-region", this, "province_select");
    })
    // Populate youth centers      
    $(document).on("change","#province_select",function(){
        fillSelectByData("/admin/get-youth-centers-by-province", this, "youth_center_select");
    })
</script>

@endsection