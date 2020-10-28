<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DienGiaiTaiChinhRequest extends FormRequest
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
            'ten_dien_giai' => 'required'
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['ten_dien_giai'] = 'required|unique:dien_giai_tai_chinhs';
                break;
            // case 'PUT':
            //     $validationRules['ten_dien_giai'] = ['required',
            //         Rule::unique('dien_giai_tai_chinhs')->ignore($this->ten_dien_giai),
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
            'ten_dien_giai.required' => 'Diễn Giải không được bỏ trống',
            'ten_dien_giai.unique' => 'Diễn Giải đã tồn tại',
        ];

    }
}
