<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
            'email' => 'required'
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['email'] = 'required|unique:admins';
                break;
            case 'PUT':
                // $validationRules['email'] = ['required',
                //     Rule::unique('admins')->ignore($this->email),
                // ];
                break;
            default:
                break;
        }
        return $validationRules;
    }

    public function messages()
    {
        return [
            'ten.required' => 'Họ và tên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'email.unique' => 'Email đã tồn tại',
        ];

    }
}
