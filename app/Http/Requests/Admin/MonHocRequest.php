<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class MonHocRequest extends FormRequest
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
            'bo_mon_id' => 'required',
            'loai_hinh' => 'required',
            'giai_doan' => 'required'
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['mon_hoc'] = 'required|unique:mon_hocs';
                break;
            // case 'PUT':
            //     $validationRules['mon_hoc'] = ['required',
            //         Rule::unique('mon_hocs')->ignore($this->id),
            //     ];
                break;
            default:
                break;
        }

        return $validationRules;
    }

    public function messages()
    {
        return [
            'mon_hoc.required' => 'Tên Môn học không được bỏ trống',
            'mon_hoc.unique' => 'Tên môn học đã tồn tại',
            'bo_mon_id.required' => 'Bộ môn không được bỏ trống',
            'giao_vien_id.required' => 'Giáo viên không được bỏ trống',
            'ngay_hoc.required' => 'Ngày bắt đầu không được bỏ trống',
            'ngay_hoc.after_or_equal' => 'Ngày bắt đầu phải lớn hơn ngày hiện tại',
            'ngay_ket_thuc.required' => 'Ngày kết thúc không được bỏ trống',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',
            'loai_hinh.required' => 'Hình Thức không được bỏ trống',
            'giai_doan.required' => 'Giai đoạn không được bỏ trống',
        ];

    }

}
