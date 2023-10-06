@extends('layouts.admin')
@section('content')
    <div class="card">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-11">
                        {{ trans('global.create') }} {{ trans('cruds.service.title_singular') }}

                    </div>
                    <div class="col-md-1">
                        <select name="status" class="form-control service status">
                            @foreach (Constants::getAllStatus() as $status)
                                <option value="{{ $status['value'] }}"> {{ $status['name'] }} </option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @csrf
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">{{ trans('cruds.service.fields.name') }} <span
                            class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                        required>
                    @if ($errors->has('name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </em>
                    @endif

                </div>
                <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                    <label for="duration">{{ trans('cruds.service.fields.duration') }} <span
                            class="text-danger">*</span></label> <input type="number" id="duration" name="duration"
                        class="form-control" value="{{ old('duration') }}" required>
                    @if ($errors->has('duration'))
                        <em class="invalid-feedback">
                            {{ $errors->first('duration') }}
                        </em>
                    @endif

                </div>
                <div class="form-group {{ $errors->has('max_places') ? 'has-error' : '' }}">
                    <label for="max_places">{{ trans('cruds.service.fields.max_places') }} <span
                            class="text-danger">*</span> </label> <input type="number" id="max_places" name="max_places"
                        class="form-control" value="{{ old('max_places') }}" required>
                    @if ($errors->has('max_places'))
                        <em class="invalid-feedback">
                            {{ $errors->first('max_places') }}
                        </em>
                    @endif
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>


            </div>
        </form>
    </div>
@endsection
