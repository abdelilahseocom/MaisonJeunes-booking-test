@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.cities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('region_id') ? 'has-error' : '' }}">
                        <label for="region_id">{{ trans("cruds.cities.fields.region") }}<span class="text-danger">* </span></label>
                        <select name="region_id" id="region_id" class="form-control select2" required>
                            @foreach ($regions as $key => $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
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
                        <label for="province_id">{{ trans("cruds.cities.fields.province") }}<span class="text-danger">* </span>  </label>
                        <select name="province_id" id="province_id" class="form-control select2" required>
                            <option value="">La liste est vide</option>
                        </select>
                        @if ($errors->has('region_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('region_id') }}
                            </em>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="province_id">{{ trans("cruds.cities.fields.name") }} <span class="text-danger">* </span></label>
                        <input type="text" class="form-control" name="name" >
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
        fillSelectProvinces();
        $(document).on("change","#region_id",function(){
            fillSelectProvinces();
        })

       
        function getProvincesByRegion() {
           return $.ajax({
                type: "POST",
                url: "{{ route('admin.get_provinces_by_region') }}",
                data: {
                    region_id: $("#region_id").val(),
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
            });
        }
       
        function fillSelectProvinces(){
            getProvincesByRegion()
            .then(function(res){
                var provinceOption=``
                if (res.error==0 && res.data!=null) {
                    res.data.forEach((element)=>{
                        provinceOption+=`<option value="${element.id}" >${element.name} </option>`;
                    })
                    $("#province_id").html(provinceOption);
                }
            })
            .catch(function(res){
                var provinceOption=`<option value=""></option>`
                $("#province_id").html(provinceOption);
            })
        }

   
    </script>
@endsection
