<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        $validationRules = [];
        $guard = get_guard_name();
        $validationRules = [
            'password' => 'required',
            'password-new' => 'required',
        ];
        // switch ($guard) {
        //     case 'nguoibaoho':
        //         $validationRules = [
        //             'password' => 'required',
        //             'password-new' => 'required',
        //         ];
        //         break;
        //     case 'admin':
        //         $validationRules = [
        //             'email' => 'required|email',
        //             'password' => 'required',
        //         ];
        //         break;
        //     default:
        //         # code...
        //         break;
        // }

        return $validationRules;
    }
}
