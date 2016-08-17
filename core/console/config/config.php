<?php
namespace core\console;

return function (array $config, array $params) {

    $config["controllerNamespace"] = "core\\console\\controllers";

    $config["controllerMap"] = [
        "migrate" => [
            "class"         => "yii\\console\\controllers\\MigrateController",
            "migrationPath" => "@core/migrations",
        ]
    ];

    return $config;
};
