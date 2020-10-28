<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.index');
    }

    public function store(LoginRequest $request)
    {
        $data = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect('user');
        }

        return redirect()->back()->withErrors(['errors' => trans('admin/auth.login_faild')]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('login');
    }
}
