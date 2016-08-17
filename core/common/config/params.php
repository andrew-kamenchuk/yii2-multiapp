<?php
namespace core\common\config;

return [
    // defaults

    "db.dsn"              => "mysql:host=127.0.0.1;port=3306;dbname=",
    "db.username"         => "root",
    "db.password"         => "",
    "db.charset"          => "utf8",
    "db.table_prefix"     => "",
    "db.cache.schema"     => true,
    "db.cache.schema.ttl" => 3360,
    "db.cache.query"      => true,
    "db.cache.query.ttl"  => 3360,

    "cache.prefix"      => APP_NAME,
    "cache.enabled"     => false,
    "cache.filecache"   => false,
    "cache.dbcache"     => false,
    "cache.memcached"   => false,
    "memcached.servers" => [
        [
            "host" => "localhost",
            "port" => 11211,
        ],
    ],

    // i18n
    "language"       => "en-En",
    "sourceLanguage" => "en-En",
];
