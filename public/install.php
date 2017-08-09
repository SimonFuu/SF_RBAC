<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 03/08/2017
 * Time: 10:05 AM
 * https://www.fushupeng.com
 * contact@fushupeng.com
 */
if (version_compare(PHP_VERSION, '5.6.4', '<='))
    die('require PHP >= 5.6.4 !');
$requireExtensions = ['OpenSSL', 'PDO', 'Mbstring', 'Tokenizer', 'XML'];
$extensionCheck = true;
foreach ($requireExtensions as $extension) {
    if(!get_extension_funcs($extension)) {
        $extensionCheck = false;
        echo (sprintf('<p>Require PHP Extension: <strong>%s</strong>!</p>', $extension));
    }
}
if (!$extensionCheck) {
    die('<h2>Please Install All The Extensions Above First!</h2>');
}

$baseDir = str_replace('\\', '/', dirname(__DIR__));
$envFile = $baseDir . '/.env';
$storageCatalog = $baseDir . '/storage';
$middlewareFile = $baseDir . '/app/Http/Middleware/RedirectIfAuthenticated.php';
if (isset($_POST['install']) && $_POST['install'] == 1) {
    if (!@($connect = mysqli_connect($_POST['db'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name']))) {
        echo "<meta charset='utf-8' />";
        echo "<script>\n
					window.onload=function(){
					alert('数据库连接失败! 请检查数据库连接参数或数据库是否存在！');
					location.href='install.php';
				}
				</script>";
        die;
    } else {
        $middleware = file_get_contents($middlewareFile);
        $needle = 'if (!env(\'APP_INSTALLED\')) {return redirect(\'/install.php\');}';
        $middleware = str_replace($needle, '', $middleware);
        file_put_contents($middlewareFile, $middleware);
        $env =
'APP_NAME=\''.$_POST['name'].'\'
APP_ENV=production
APP_KEY=base64:yTwTabrgIAF4KpK4ZQKdyWMhZXh9kfaAk6pnQvmOwmI=
APP_DEBUG=false
APP_LOG=daily
APP_LOG_FILES_COUNT=30
APP_LOG_LEVEL=debug
APP_URL=
APP_FILE_SERVER_URL='.$_POST['file_server'].'
APP_ASSETS_VERSION='.date('Ymd').'
APP_TIMEZONE=PRC
APP_INSTALLED=true

DB_CONNECTION=mysql
DB_HOST='.$_POST['db'].'
DB_PORT=3306
DB_DATABASE='.$_POST['db_name'].'
DB_USERNAME='.$_POST['db_user'].'
DB_PASSWORD='.$_POST['db_password'].'
DB_PREFIX='.$_POST['db_prefix'].'

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
';
        $ff = fopen($envFile, 'w');
        fwrite($ff, $env);
        unlink('install.php');
        header('Location:/install/db');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Install</title>
    <link rel="stylesheet" href="/assets/plugins/bootstrap-3.3.7/css/bootstrap.min.css">
    <script src="/assets/plugins/jquery-3.2.1/jquery-3.2.1.min.js"></script>
    <script src="/assets/plugins/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <style>
        form{
            padding: 20px;
            background: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
        }
        .submit-button {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main col-md-offset-2 col-md-8">
            <h1>Welcome To SF RBAC</h1>
            <div class="row">
                <form action="/install.php" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-4">.env Writable：</label>
                        <div class="col-md-8">
                            <?php
                            if (is_writable($envFile)) {
                                echo '<button type="button" class="btn btn-success">True</button>';
                            } else {
                                echo '<button type="button" class="btn btn-danger">False, check whether it is writable!</button>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Storage Catalog Writable：</label>
                        <div class="col-md-8">
                            <?php
                            if (is_writable($storageCatalog)) {
                                echo '<button type="button" class="btn btn-success">True</button>';
                            } else {
                                echo '<button type="button" class="btn btn-danger">False, check whether it is writable!</button>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Redirect Middleware Writable：</label>
                        <div class="col-md-8">
                            <?php
                            if (is_writable($middlewareFile)) {
                                echo '<button type="button" class="btn btn-success">True</button>';
                            } else {
                                echo '<button type="button" class="btn btn-danger">False, check whether it is writable!</button>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="name" class="col-md-4 control-label">APP Name：</label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="应用名！" name="name" type="text" id="name" required value="SF_RBAC">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="server" class="col-md-4 control-label">File Server：</label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="域名URL，包含'http(s)://'部分！！" name="file_server" type="text" id="server" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="db" class="col-md-4 control-label">DB Server：</label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="数据库服务器地址" name="db" type="text" id="db" required value="localhost">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="db_user" class="col-md-4 control-label">DB User：</label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="数据库用户名！" name="db_user" type="text" id="db_user" required value="root">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="db_password" class="col-md-4 control-label">DB Password：</label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="数据库密码！" name="db_password" type="text" id="db_password" required value="root">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="db_name" class="col-md-4 control-label">DB Name：</label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="数据库！" name="db_name" type="text" id="db_name" required value="sf_rbac">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="db_prefix" class="col-md-4 control-label">DB Prefix：</label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="数据库前缀！" name="db_prefix" type="text" id="db_prefix" required value="sf_rbac_">
                        </div>
                    </div>
                    <input type="hidden" name="install" value="1">
                    <div class="submit-button">
                        <button type="submit" class="btn btn-info">开始安装</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        $('#server').val(window.location.protocol + '//' + window.location.host);
        if ($('.btn-success').length !== 3) {
            $('.submit-button > button').prop('disabled', true);
        }
    });
</script>
</body>
</html>