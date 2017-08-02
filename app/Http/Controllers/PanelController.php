<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PanelController extends Controller
{
    public function initPassword()
    {
        return view('panel.init.password');
    }

    public function storeInitPassword(Request $request)
    {
        $this -> validate($request,
            ['password' => 'required|min:6|max:255|confirmed'],
            [
                'required' => '请输入密码！',
                'min' => '密码长度最低为6！',
                'max' => '密码长度最高为255！',
                'confirmed' => '两次输入的密码长度不一致！',
            ]
        );
        DB::table('system_users')
            -> where('id', Auth::user() -> id)
            -> update(['password' => bcrypt($request -> password), 'isActive' => 1]);
        Auth::guard() -> logout();
        $request -> session() -> flush();
        $request -> session() -> regenerate();
        return redirect('/login') -> with('success', '密码修改成功，请重新登录！');
    }
}
