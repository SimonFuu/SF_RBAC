<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    private function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect($this -> redirectTo);
        }
        return view('login');
    }

    public function loginCheck(Request $request)
    {
        if (Auth::attempt(['username' => $request -> username, 'password' => $request -> password])) {
            if (Auth::user() -> isActive == 0) {
                return redirect('/panel/init/password');
            }
            $userRolesId = [];
            $userRolesItems = DB::table('system_users_roles')
                -> select('rid') -> where('isDelete', 0) -> where('uid', Auth::user() -> id) -> get();
            if (count($userRolesItems) !== 0) {
                foreach ($userRolesItems as $item) {
                    $userRolesId[] = $item -> rid;
                }
                $roles = $this -> getRoleActionsInfo($userRolesId);
                Session::put('menus', $roles['menus']);
                Session::put('permissions', $roles['permissions']);
                DB::table('system_users')
                    -> where('id', Auth::user() -> id)
                    -> increment('loginTimes', 1, ['lastLoginIp' => $request -> ip()]);
                return redirect($this -> redirectTo);
            } else {
                Auth::logout();
                return redirect('/login') -> with('error', '用户角色状态异常，请联系管理员！');
            }
        } else {
            return $this -> sendFailedLoginResponse($request);
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => '用户名或密码错误，请重试！'];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login') -> with('success', '已退出登录！');
    }
}
