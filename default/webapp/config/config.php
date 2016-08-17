<?php
namespace app\webapp\config;

return function (array $config, array $params) {

    $config["controllerMap"] = [
        "default" => "app\\webapp\\controllers\\DefaultController"
        // and so on..
    ];

    $config["components"]["urlManager"]["rules"] = array_merge($config["components"]["urlManager"]["rules"], [
        // url rules
    ]);

    return $config;
};
