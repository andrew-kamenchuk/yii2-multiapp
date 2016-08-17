<?php
namespace core\console;

use function core\common\buildConfig;

require __DIR__ . "/../common/bootstrap.php";

exit((new \yii\console\Application(buildConfig("console")))->run());
