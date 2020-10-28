<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KinhThanhRequest extends FormRequest
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
        $validationRules = [
            'mon_hoc' => 'required',
            'ngay_hoc' => 'required',
            'giai_doan' => 'required'
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['mon_hoc'] = 'required|unique:kinh_thanhs';
                break;
            case 'PUT':
                $validationRules['mon_hoc'] = ['required',
                    Rule::unique('kinh_thanhs')->ignore($kinh_thanhs->id),
                ];
                break;
            default:
                break;
        }
        return $validationRules;
    }

    public function messages()
    {
        return [
            'mon_hoc.required' => 'Môn học không được bỏ trống',
            'mon_hoc.unique' => 'Môn học đã tồn tại',
            'giai_doan.required' => 'Giai đoạn học không được bỏ trống',
        ];

    }
}
