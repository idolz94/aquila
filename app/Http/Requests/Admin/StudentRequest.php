<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'ho_va_ten_nguoi_bao_ho' => 'required',
            'dia_chi' => 'required',
            'so_dien_thoai'=>'required',
            // 'ngay_vao'=>'required',
            // 'ngay_sinh' => 'required',
            // 'so_cmnd' => 'required',
            // 'gioi_tinh' => 'required',
            // 'noi_cap_cmnd' => 'required',
            // 'tien_su_benh_ly' => 'required',
            // 'chieu_cao' => 'required',
            // 'can_nang' => 'required',
            // 'ma_tuy_su_dung' => 'required',
            // 'hinh_thuc_su_dung' => 'required',
            // 'avatar_hocvien' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'images.*' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ];

        switch ($this->method()) {
            case 'POST':
                // $validationRules['so_cmnd'] = 'required|unique:hoc_viens';
                $validationRules['so_dien_thoai'] = 'required|unique:nguoi_bao_hos';
                break;
            case 'PUT':
                $validationRules['so_cmnd'] = ['required',
                    Rule::unique('hoc_viens')->ignore($hoc_viens->id),
                ];
                $validationRules['email'] = ['required',
                    Rule::unique('nguoi_bao_hos')->ignore($nguoi_bao_hos->email),
                ];
                $validationRules['so_dien_thoai'] = ['required',
                    Rule::unique('nguoi_bao_hos')->ignore($nguoi_bao_hos->so_dien_thoai),
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
            'ten.required' => 'Tên học viên không được bỏ trống',
            'ho_va_ten_nguoi_bao_ho.required' => 'Tên người bảo hộ không được bỏ trống',
            'dia_chi.required' => 'Địa chỉ không được bỏ trống',
            // 'ngay_vao.required' => 'Ngày vào không được bỏ trống',
            // 'ngay_sinh.required' => 'Ngày sinh không được bỏ trống',
            // 'so_cmnd.required' => 'CMND không được bỏ trống',
            // 'gioi_tinh.required' => 'Giới tính không được bỏ trống',
            // 'ngay_cap_cmnd.required' => 'Ngày cấp cmnd không được bỏ trống',
            // 'noi_cap_cmnd.required' => 'Nơi cấp cmnd không được bỏ trống',
            // 'tien_su_benh_ly.required' => 'Tiền sử bệnh lý không được bỏ trống',
            // 'chieu_cao.required' => 'Chiều Cao không được bỏ trống',
            // 'can_nang.required' => 'Cân nặng không được bỏ trống',
            // 'ma_tuy_su_dung.required' => 'Ma tuý sử dụng không được bỏ trống',
            // 'hinh_thuc_su_dung.required' => 'Hình thức sử dụng không được bỏ trống',
            'avatar_hocvien.required' => 'Ảnh đại diện không được bỏ trống',
            'so_dien_thoai.required' => 'Số điện thoại không được bỏ trống',
        ];

    }
}
