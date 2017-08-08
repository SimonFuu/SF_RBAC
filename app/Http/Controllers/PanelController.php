<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
// TODO 1 初始化密码，添加一个判断，已经初始化过的用户，直接跳转到首页; 2、完成个人中心的相关页面与设置！
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

    public function userCenter()
    {
        $userInfo = DB::table('system_users')
            -> select('id', 'username', 'name', 'gender', 'email', 'telephone', 'avatar')
            -> where('isDelete', 0)
            -> where('id', Auth::user() -> id)
            -> first();
        return view('panel.user', ['userProfile' => $userInfo]);
    }

    public function editProfile()
    {
        $userInfo = DB::table('system_users')
            -> select('id', 'username', 'name', 'gender', 'email', 'telephone', 'avatar')
            -> where('isDelete', 0)
            -> where('id', Auth::user() -> id)
            -> first();
        return view('panel.set', ['userProfile' => $userInfo]);
    }

    public function storeUserProfile(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'password' => 'confirmed|max:255' . ($request -> password == '' ? '' : '|min:6'),
            'telephone' => 'required|unique:system_users,telephone,'. Auth::user() -> id . ',id,isDelete,0|digits_between:11,11',
            'email' => 'required|unique:system_users,email,'. Auth::user() -> id . ',id,isDelete,0',
            'gender' => 'required|boolean',
            'file' => 'image|max:1500'
        ];
        $message = [
            'name.required' => '请输入姓名！',
            'name.max' => '姓名长度最大为255！',
            'password.confirmed' => '两次输入的密码不一致！',
            'password.max' => '密码长度最大为255位！',
            'password.min' => '密码长度最低为6位！',
            'telephone.required' => '请输入电话号码',
            'telephone.digits_between' => '请输入11位长度手机号！',
            'telephone.unique' => '该手机号已经存在',
            'email.required' => '请输入邮件地址！',
            'email.email' => '邮件格式不正确！',
            'email.unique' => '该邮件地址已经存在，请确认！',
            'gender.required' => '请选择用户性别',
            'gender.boolean' => '用户性别格式不正确！',
            'file.image' => '请上传图片类型文件！',
            'file.max' => '头像文件最大为1500k',
        ];
        $this -> validate($request, $rules, $message);
        $avatar = null;
        $request -> type = 'avatar';
        if ($request -> file('file')) {
            $uploader = new UploadController();
            $avatar = $uploader -> storeFile($request);
        }
        $req['name'] = $request -> name;
        $req['gender'] = $request -> gender;
        $req['telephone'] = $request -> telephone;
        $req['email'] = $request -> email;
        $req['gender'] = $request -> gender;
        if ($request -> password) {
            $req['password'] = bcrypt($request -> password);
        }
        if ($avatar) {
            $req['avatar'] = $avatar;
        }

        DB::table('system_users') -> where('id', Auth::user() -> id) -> update($req);
        return redirect('/panel/user/center?id=' . Auth::user() -> id) -> with('success', '修改信息成功，请刷新页面获取新的头像');
    }
}
