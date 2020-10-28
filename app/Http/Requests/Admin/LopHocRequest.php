<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LopHocRequest extends FormRequest
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
            'ma_lop_hoc'=>'required',
            'ngay_bat_dau' => 'required|date_format:Y-m-d',
            'ngay_ket_thuc' => 'required|date_format:Y-m-d|after:ngay_bat_dau',
            'mon_hoc_id' => 'required',
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['ma_lop_hoc'] = 'required|unique:lop_hocs';
                break;
            // case 'PUT':
            //     $validationRules['ma_lop_hoc'] = ['required',
            //         Rule::unique('lop_hocs')->ignore($lop_hocs->id),
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
            'ma_lop_hoc.required' => 'Mã lớp học không được bỏ trống',
            'ma_lop_hoc.unique' => 'Mã lớp học đã tồn tại',
            'ngay_bat_dau.required' => 'Ngày bắt đầu không được bỏ trống',
            'ngay_ket_thuc.required' => 'Ngày kết thúc không được bỏ trống',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',
            'mon_hoc_id.required' => 'Môn Học không được bỏ trống',
        ];

    }
}
