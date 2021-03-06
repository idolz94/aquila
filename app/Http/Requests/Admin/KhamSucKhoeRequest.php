<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class KhamSucKhoeRequest extends FormRequest
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
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['ten'] = 'required|unique:kham_suc_khoes';
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
            'ten.required' => 'khám sức khoẻ không được bỏ trống',
        ];

    }
}
