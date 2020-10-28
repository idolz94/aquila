<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BoMonRequest extends FormRequest
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
            'ten_bo_mon' => 'required'
        ];

        switch ($this->method()) {
            case 'POST':
                $validationRules['ten_bo_mon'] = 'required|unique:bo_mons';
                break;
            case 'PUT':
                $validationRules['ten_bo_mon'] = ['required',
                    Rule::unique('bo_mons')->ignore($this->ten_bo_mon),
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
            'ten_bo_mon.required' => 'Bộ môn không được bỏ trống',
            'ten_bo_mon.unique' => 'Bộ môn đã tồn tại',
        ];

    }
}
