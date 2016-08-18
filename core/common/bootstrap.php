<?php
namespace core\common;

use Yii;

defined("YII_ENV")   or define("YII_ENV", "dev");
defined("YII_DEBUG") or define("YII_DEBUG", YII_ENV == "dev");

require APP_PATH . "/vendor/autoload.php";

error_reporting(E_ALL ^ E_USER_DEPRECATED);
ini_set("display_errors", YII_DEBUG);

define("CORE_PATH", dirname(__DIR__));
