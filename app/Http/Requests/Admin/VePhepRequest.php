<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class VePhepRequest extends FormRequest
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
            'ngay_ve' => 'required',
            // 'ngay_vao' => 'after:ngay_ve',
            'hoc_vien_id' => 'required',
        ];

        switch ($this->method()) {
            // case 'POST':
            //     $validationRules['ten'] = 'required|unique:ve_pheps';
            //     break;
            // case 'PUT':
            //     $validationRules['ten_phong'] = ['required',
            //         Rule::unique('phongs')->ignore($this->id),
            //     ];
            //     break;
            default:
                break;
        }

        return $validationRules;
    }

    public function messages()
    {
        return [
            'ngay_ve.required' => 'Ngày bắt đầu không được bỏ trống',
            // 'ngay_vao.after' => 'Ngày vào phải lớn hơn ngày về',
            'hoc_vien_id.required' => 'Học viên không có',
        ];

    }
}
