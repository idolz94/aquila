<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Notifications\ResetPasswordRequest;
use App\Models\Admin;
use App\Models\NguoiBaoHo;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function index()
    {
        $guard = get_guard_current();

        return view('admin.auth.forgot_password', compact('guard'));
    }

    public function formForgot($token)
    {
        $guard = get_guard_current();

        return view('admin.auth.recover-password', compact('guard', 'token'));
    }

    public function sendMailWithToken(Request $request)
    {
        $guard = get_guard_current();

        if ($request->type == 'admin') {
            $data = $request->only(['email']);
            $user = Admin::where('email', $data['email'])->first();
            if (!$user) {
                return redirect()->back()->withErrors(['errors' => ['auth.failed' => "Không tìm thấy email này"]]);
            }

            if ($user) {
                $passwordReset = PasswordReset::updateOrCreate([
                    'email' => $user->email,
                    'token' => Str::random(60) . $user->id,
                ]);

                if ($passwordReset) {
                    $user->notify(new ResetPasswordRequest($passwordReset->token, $request->type));
                }

                return redirect()->back()->withErrors(['errors' => ['auth.failed' => "Bạn hãy xác thực thông báo trong email của bạn."]]);
            }

        } else if ($request->type == 'nguoibaoho') {
            $data = $request->only(['email']);
            $user = NguoiBaoHo::where('email', $data['email'])->first();

            if ($user) {
                $passwordReset = PasswordReset::updateOrCreate([
                    'email' => $user->email,
                    'token' => Str::random(60) . $user->id,
                ]);

                if ($passwordReset) {
                    $user->notify(new ResetPasswordRequest($passwordReset->token, $request->type));
                }

                return redirect()->back()->withErrors(['errors' => ['auth.failed' => "Bạn hãy xác thực thông báo trong email của bạn."]]);
            }
        }

        return redirect()->back();
    }

    public function changePassword(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return redirect()->route('forgot.index')->with([
                'message' => "Bạn đã quá thời gian xác thực",
            ]);
        }
        
        if ($request->type == 'admin') {
            $user = Admin::where('email', $passwordReset->email)->firstOrFail();
            $updatePasswordUser = $user->update(['password' => Hash::make($request->password)]);
            $passwordReset->delete();
        }

        if ($request->type == 'nguoibaoho') {
            $user = NguoiBaoHo::where('email', $passwordReset->email)->firstOrFail();
            $updatePasswordUser = $user->update(['password' => Hash::make($request->password)]);
            $passwordReset->delete();
        }

        return redirect()->route('login.' . $request->type);
    }
}
