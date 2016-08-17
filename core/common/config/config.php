<?php
namespace core\common\config;

return function (array $config, array $params) {
    $config["id"]         = APP_NAME;

    $config["name"]       = APP_NAME;

    $config["params"]     = $params;

    $config["basePath"]   = APP_PATH;

    $config["bootstrap"]  = ["log"];

    $config["components"] = [

        "log" => [
            "traceLevel" => YII_DEBUG ? 3 : 0,
            "targets"    => [
                [
                    "class" => "yii\\log\\FileTarget",
                ],
            ],
        ],

        "db" => [
            "class"                 => "yii\\db\\Connection",
            "dsn"                   => $params["db.dsn"],
            "username"              => $params["db.username"],
            "password"              => $params["db.password"],
            "charset"               => $params["db.charset"],
            "tablePrefix"           => $params["db.table_prefix"],
            "enableSchemaCache"     => $params["db.cache.schema"],
            "schemaCacheDuration"   => $params["db.cache.schema.ttl"],
            "enableQueryCache"      => $params["db.cache.query"],
            "queryCacheDuration"    => $params["db.cache.query.ttl"],
        ],

        "i18n" => [
            "translations" => [
                "*" => [
                    "class"    => "yii\\i18n\\PhpMessageSource",
                    "basePath" => "@core/common/messages",
                ],
            ],
        ],
    ];

    $enabledCache = $params["cache.enabled"];

    switch (true) {
        case $enabledCache && $params["cache.memcached"]:
            $config["components"]["cache"] = [
                "class"        => "yii\\caching\\MemCache",
                "useMemcached" => true,
                "servers"      => $params["memcached.servers"],
                "keyPrefix"    => $params["cache.prefix"],
            ];
            break;

        case $enabledCache && $params["cache.dbcache"]:
            $config["components"]["cache"] = [
                "class"      => "yii\\caching\\DbCache",
                "cacheTable" => $params["dbcache.table"],
                "keyPrefix"  => $params["cache.prefix"],
            ];
            break;

        case $enabledCache && $params["cache.filecache"]:
            $config["components"]["cache"] = [
                "class"     => "yii\\caching\\FileCache",
                "keyPrefix" => $params["cache.prefix"],
            ];
            break;

        default:
            $config["components"]["cache"] = [
                "class" => "yii\\caching\\DummyCache",
            ];
    }

    if (YII_DEBUG) {
        $config["bootstrap"][] = "debug";
        $config["modules"]["debug"] = [
            "class" => "yii\\debug\\Module",
        ];

        $config["bootstrap"][] = "gii";
        $config["modules"]["gii"] = [
            "class" => "yii\\gii\\Module",
        ];
    }

    return $config;
};
