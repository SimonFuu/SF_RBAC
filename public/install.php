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
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="" method="POST" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-4">.env Writable：</label>
                    <div class="col-md-8">
                        <?php
                            if (is_writable($envFile)) {
                                echo '<button type="button" class="btn btn-success">True</button>';
                            } else {
                                echo '<button type="button" class="btn btn-danger">False</button>';
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Storage Catalog Writable：</label>
                    <div class="col-md-8">
                        <?php
                            if (is_writable($envFile)) {
                                echo '<button type="button" class="btn btn-success">True</button>';
                            } else {
                                echo '<button type="button" class="btn btn-danger">False</button>';
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
                                echo '<button type="button" class="btn btn-danger">False</button>';
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
///**
// * Created by PhpStorm.
// * User: simon
// * Date: 03/08/2017
// * Time: 10:05 AM
// * https://www.fushupeng.com
// * contact@fushupeng.com
// */
//

//
//$middleware = file_get_contents($middlewareFile);
//$needle = 'if (!env(\'APP_INSTALLED\')) {return redirect(\'/install.php\');}';
//$middleware = str_replace($needle, '', $middleware);
//file_put_contents($middlewareFile, $middleware);
//var_dump($middleware);
//var_dump(is_writeable($middlewareFile));
//var_dump($baseDir, $storageCatalog);
////if ($_POST['params']) {
////
////}
//$env =
//'APP_NAME=\'RBAC | 后台管理系统\'
//APP_ENV=production
//APP_DEBUG=false
//APP_LOG=daily
//APP_LOG_FILES_COUNT=30
//APP_LOG_LEVEL=debug
//APP_URL=
//APP_FILE_SERVER_URL=
//APP_ASSETS_VERSION=20170717
//APP_TIMEZONE=PRC
//APP_INSTALLED=true
//
//DB_CONNECTION=mysql
//DB_HOST=127.0.0.1
//DB_PORT=3306
//DB_DATABASE=lvs_oa
//DB_USERNAME=livsion
//DB_PASSWORD=livsion
//DB_PREFIX=lvs_
//
//BROADCAST_DRIVER=log
//CACHE_DRIVER=file
//SESSION_DRIVER=file
//QUEUE_DRIVER=sync
//';
//?>
