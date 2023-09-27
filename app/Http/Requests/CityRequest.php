<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "region_id"=>["required"],
            "province_id"=>["required"],
            "name"=>["required"],
        ];
    }
    public function messages()
    {
        return [
            "region_id.required"=>trans('validation.required',["attribute"=>trans('cruds.cities.fields.region')]),
            "province_id.required"=>trans('validation.required',["attribute"=>trans('cruds.cities.fields.province')]),
            "name.required"=>trans('validation.required',["attribute"=>trans('cruds.cities.fields.name')]),
        ];
    }
}