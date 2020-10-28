<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class PhongRequest extends FormRequest
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
            'ten_phong' => 'required',
            'vi_tri' => 'required',
            'ten_truong_phong' => 'required',
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['ten_phong'] = 'required|unique:phongs';
                break;
            case 'PUT':
                $validationRules['ten_phong'] = ['required',
                    Rule::unique('phongs')->ignore($this->id),
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
            'ten_phong.required' => 'Tên phòng không được bỏ trống',
            'ten_phong.unique' => 'Tên Phòng đã có, mời nhập tên khác',
            'vi_tri.required' => 'Vị trí phòng không được bỏ trống',
            'ten_truong_phong.required' => 'Tên trưởng phòng không được bỏ trống',
        ];

    }
}
