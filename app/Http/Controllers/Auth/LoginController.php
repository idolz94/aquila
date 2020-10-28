<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\NguoiBaoHo;
use Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/profile';

    protected $typeRedirectTo = [
        'nguoibaoho' => 'nguoibaoho.home',
        'admin' => 'admin.dashboard',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function index(Request $request)
    {
        $guard = get_guard_current();
        return view('nguoinha.pages.login', compact('guard'));
    }

    public function store(LoginRequest $request)
    {
        $message = trans('admin/auth.login_by_email_faild');
        $isRemember = ($request->has('remember_me') && $request->get('remember_me') == 'on') ? true : false;
        if ($request->type == 'admin') {
            $data = $request->only(['email', 'password']);
            $user = Admin::where('email', $data['email'])->first();
            if (!$user) {
                return redirect()->back()->withErrors(['errors' => ['auth.failed' => trans('admin/auth.deactive_login')]]);
            }

            if ($user && Hash::check($data['password'], $user->password)) {
                Auth::guard('admin')->login($user, $isRemember);
                return redirect()->route($this->typeRedirectTo['admin']);
            }
        } else if ($request->type == 'nguoibaoho') {
            $data = $request->only(['username', 'password']);

            $user = NguoiBaoHo::Where('so_dien_thoai', $data['username'])->first();
            if (!$user) {

                return redirect()->back()->withErrors(['errors' => ['auth.failed' => trans('admin/auth.deactive_login')]]);
            }

            if ($user && Hash::check($data['password'], $user->password)) {
                Auth::guard('nguoibaoho')->login($user, $isRemember);
                return redirect()->route($this->typeRedirectTo['nguoibaoho']);
            }

            $message = trans('admin/auth.login_faild');
        }

        return redirect()->back()->withErrors(['errors' => ['auth.failed' => $message]]);
    }

    public function logout(Request $request)
    {
        $guard = get_guard_current();
        $guards = ['nguoibaoho', 'admin'];
        if (in_array($guard, $guards)) {
            Auth::guard($guard)->logout();

            return redirect('login');
        }

        return redirect('/');
    }
}
