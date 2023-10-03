<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YouthCenterRequest extends FormRequest
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
            "name"=>["required"],
            "city_id"=>["required"],
            'services.*'   => 'required|array',
            // 'services.*.service_id' => ["required"],
            'services.*.duration' => ["required_if:services.*.is_checked,true"],
            'services.*.max_places' => ["required_if:services.*.is_checked,true"],
            'services.*.status' => ["required_if:services.*.is_checked,true"],
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>trans('validation.required',["attribute"=>trans("cruds.youth_centers.fields.name")]),
            "city_id.required"=>trans('validation.required',["attribute"=>trans("cruds.youth_centers.fields.city")]),
            "services.required"=>trans('validation.required',["attribute"=>trans("cruds.youth_centers.fields.services.*")]),
            "services.*.service_id.required"=>trans('validation.required',["attribute"=>trans("cruds.youth_centers.fields.services.name")]),
            "services.*.duration.required_if"=>trans('validation.required',["attribute"=>trans("cruds.youth_centers.fields.services.duration")]),
            "services.*.max_places.required_if"=>trans('validation.required',["attribute"=>trans("cruds.youth_centers.fields.services.max_places")]),
            "services.*.status.required_if"=>trans('validation.required',["attribute"=>trans("cruds.youth_centers.fields.services.status")]),
        ];
    }
}
