<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class NhomChaRequest extends FormRequest
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
                $validationRules['ten'] = 'required|unique:nhom_chas';
                break;
            case 'PUT':
                $validationRules['ten'] = ['required',
                    Rule::unique('nhom_chas')->ignore($this->id),
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
            'ten.required' => 'Tên nhóm cha không được bỏ trống',
            'ten.unique' => 'Tên nhóm đã có, mời nhập tên khác',

        ];

    }
}
