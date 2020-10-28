<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SuKienRequest extends FormRequest
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
            'ngay_ket_thuc' => 'required|date_format:Y-m-d|after:ngay_bat_dau',
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['ten'] = 'required|unique:su_kiens';
                break;
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
            'ten.required' => 'Tên sự kiện không được bỏ trống',
            'ngay_bat_dau.required' => 'Ngày bắt đầu không được bỏ trống',
            'ngay_ket_thuc.required' => 'Ngày kết thúc không được bỏ trống',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',
        ];

    }
}
