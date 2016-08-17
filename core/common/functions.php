<?php
namespace core\common;

use Yii;
use yii\helpers\VarDumper;

function dump(...$variables)
{
    if (!YII_DEBUG) {
        return;
    }

    /* if (extension_loaded('xdebug') && ini_get('xdebug.overload_var_dump')) {
        return var_dump(...$variables);
    } */

    foreach ($variables as $variable) {
        VarDumper::dump($variable, 10);
    }
}

/**
 * @param string $appSubPath
 * @return mixed[] config
 */

function buildConfig($appSubPath)
{
    $paths = [
        CORE_PATH . "/common/config",
        CORE_PATH . "/$appSubPath/config",
        APP_PATH  . "/common/config",
        APP_PATH  . "/$appSubPath/config",
    ];

    $params = [];

    foreach ($paths as $path) {
        if (is_file($file = "$path/params.php")) {
            $params[] = require($file);
        }
    }

    if (!empty($params)) {
        $params = array_merge(...$params);
    }

    $config = [];

    foreach ($paths as $path) {
        if (is_file($file = "$path/config.php")) {
            $config = call_user_func(require $file, $config, $params);
        }
    }

    return $config;
}
