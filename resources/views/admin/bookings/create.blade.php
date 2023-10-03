@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.bookings.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                <label for="client">{{ trans('cruds.booking.fields.client') }}*</label>
                <select name="client_id" id="client" class="form-control select2" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ (isset($booking) && $booking->client ? $booking->client->id : old('client_id')) == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('client_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                <label for="start_time">{{ trans('cruds.booking.fields.start_time') }}*</label>
                <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($booking) ? $booking->start_time : '') }}" required>
                @if($errors->has('start_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.start_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
                <label for="end_time">{{ trans('cruds.booking.fields.end_time') }}*</label>
                <input type="text" id="end_time" name="end_time" class="form-control datetime" value="{{ old('end_time', isset($booking) ? $booking->end_time : '') }}" required>
                @if($errors->has('end_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.end_time_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                <label for="comment">{{ trans('cruds.booking.fields.comment') }}</label>
                <textarea id="comment" name="comment" class="form-control ">{{ old('comment', isset($booking) ? $booking->comment : '') }}</textarea>
                @if($errors->has('comment'))
                    <em class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.booking.fields.comments_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                <label for="type">Type<span class="text-danger">* </span></label>
                <select name="type" id="type" class="form-control" required>
                    <option value="">Veuillez sélectionner une option</option>
                    @foreach (Constants::getBookingTypes() as $type)
                        <option value="{{ $type['value'] }}">{{ $type['name'] }}</option>
                    @endforeach
                </select>
                @if ($errors->has('type'))
                    <em class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection