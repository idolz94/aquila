<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class NhomRequest extends FormRequest
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
            'ten' => 'required',
            'ngay_bat_dau' => 'required|date_format:Y-m-d',
            'ngay_ket_thuc' => 'date_format:Y-m-d|after:ngay_bat_dau',
            'nhom_cha_id' => 'required',
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['ten'] = 'required|unique:nhoms';
                break;
            // case 'PUT':
            //     $validationRules['ten'] = ['required',
            //         Rule::unique('nhoms')->ignore($this->id),
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
            'ten.required' => 'Tên nhóm không được bỏ trống',
            'ten.unique' => 'Tên nhóm đã có, mời nhập tên khác',
            'ngay_bat_dau.required' => 'Ngày bắt đầu không được bỏ trống',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',
            'nhom_cha_id.required' => 'Nhóm cha Không Có',
        ];

    }
}
