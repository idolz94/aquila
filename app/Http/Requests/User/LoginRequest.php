<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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

        switch ($guard) {
            case 'nguoibaoho':
                $validationRules = [
                    'username' => 'required',
                    'password' => 'required',
                ];
                break;
            case 'admin':
                $validationRules = [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
                break;
            default:
                # code...
                break;
        }

        return $validationRules;
    }
}
