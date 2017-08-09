<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InstallController extends Controller
{
    public function installDB()
    {
        try {
            $count = DB::table('migrations') -> count();
            if ($count > 0) {
                return redirect('/login') -> with('success', '你已经成功安装SF_RBAC！');
            } else {
                return redirect('/install.php');
            }
        } catch (\Exception $e) {
//            Artisan::call('key:generate', ['--force' => true]);
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
        }
        return redirect('/login') -> with('success', '安装成功<br>初始用户名admin，密码111111');
    }
}
