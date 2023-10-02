@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} 
        </div>

        <div class="card-body">
            <form action="{{ route('admin.cities.update',["city"=>$city->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                        <label for="region_id">{{ trans("cruds.cities.fields.region") }} <span class="text-danger">* </span></label>
                        <select name="region_id" id="region_id" class="form-control select2" required>
                            @foreach ($regions as $key => $region)
                                <option {{ $city->province->region->id==$region->id ? "selected" : "" }} value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('region_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('region_id') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
                        <label for="province_id">{{ trans("cruds.cities.fields.province") }} <span class="text-danger">* </span>  </label>
                        <select name="province_id" id="province_id" class="form-control select2" required>
                            <option value=""></option>
                            @foreach($provinces as $id => $province)
                                <option value="{{ $id }}" {{ old('province_id') || $id==$city->province->id ? "selected" : "" }}>{{ $province }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('province_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('province_id') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="province_id">{{ trans("cruds.cities.fields.name") }} <span class="text-danger">* </span></label>
                        <input type="text" value="{{ $city->name }}" class="form-control" name="name" >
                        @if ($errors->has('name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans("global.save") }}">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Populate Provinces      
        $(document).on("change","#region_id",function(){
            fillSelectByData("/admin/get-provinces-by-region", this, "province_id");
        })
    </script>
@endsection
