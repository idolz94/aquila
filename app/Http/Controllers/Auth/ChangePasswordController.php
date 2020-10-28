<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\NguoiBaoHo;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index()
    {
        $guard = get_guard_current();
        
        return view('nguoinha.pages.change-password', compact('guard'));
    }

    public function store(ChangePasswordRequest $request)
    {
        if ($request->type == "nguoibaoho")
        {
            if(Hash::check($request['password'], Auth::guard('nguoibaoho')->user()->password))
            {           
                $user_id = Auth::guard('nguoibaoho')->user()->id;                       
                $obj_user = NguoiBaoHo::find($user_id);
                $obj_user->password = Hash::make($request['password-new']);
                $obj_user->save(); 

                return redirect()->route('logout.nguoibaoho');
            }
        }

        if ($request->type == "admin")
        {
            if(Hash::check($request['password'], Auth::guard('admin')->user()->password))
            {           
                $user_id = Auth::guard('admin')->user()->id;                       
                $obj_user = Admin::find($user_id);
                $obj_user->password = Hash::make($request['password-new']);
                $obj_user->save(); 

                return redirect()->route('logout.admin');
            }
        }

        return false;
    }
}
