<?php
namespace core\webapp\web;

use function core\common\buildConfig;

require __DIR__ . "/../../common/bootstrap.php";

(new \yii\web\Application(buildConfig("webapp")))->run();
