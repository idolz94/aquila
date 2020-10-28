<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GiaoVienRequest extends FormRequest
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
            'email' => 'required',
            'chuc_vu_id' => 'required',
            'he_phai_id' => 'required',
            'quoc_gia' => 'required',
            'ngay_sinh' => 'required',
            'so_dien_thoai' => 'required|numeric',
            // 'anh_dai_dien' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['email'] = 'required|unique:giao_viens';
                break;
            // case 'PUT':
            //     $validationRules['ten'] = ['required',
            //         Rule::unique('giao_viens')->ignore($giao_viens->id),
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
            'ten.required' => 'Tên giáo viên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'email.unique' => 'Email đã bị trùng',
            'quoc_gia.required' => 'Quốc gia không được bỏ trống',
            'ngay_sinh.required' => 'Ngày sinh không được bỏ trống',
            'so_dien_thoai.required' => 'Số điện thoại không được bỏ trống',
            'so_dien_thoai.numeric' => 'Số điện thoại phải là số',
            'chuc_vu_id.required' => 'Chức vụ không được bỏ trống',
            'he_phai_id.required' => 'Hệ phái không được bỏ trống',
            'anh_dai_dien.mimes' => 'Ảnh không đúng định dạng',
            'anh_dai_dien.max' => 'Ảnh dung lượng quá lớn',
        ];

    }
}
