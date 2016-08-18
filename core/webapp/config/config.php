<?php
namespace core\webapp\config;

return function (array $config, array $params) {

    $config["controllerNamespace"] = "core\\webapp\\controllers";

    $config["defaultRoute"] = "default/index";

    $config["components"]["request"] = [
        "enableCookieValidation" => $params["cookie.validation.enabled"],
        "cookieValidationKey"    => $params["cookie.validation.key"],
        "enableCsrfValidation"   => $params["csrf.validation.enabled"],
    ];

    $config["layout"] = false;

    $config["components"]["view"] = [
        "renderers"        => [
            "html" => [
                "class"     => "yii\\twig\\ViewRenderer",
                "cachePath" => "@runtime/twig",
                "options"   => [
                    "auto_reload" => YII_DEBUG,
                    "debug"       => YII_DEBUG,
                ],
                "functions" => [
                    "href" => "yii\\helpers\\Url::toRoute",
                ],
                "filters"   => [
                    "yiit" => "Yii::t",
                ],
            ],
        ],
    ];

    if (YII_DEBUG) {
        $config["components"]["view"]["renderers"]["html"]["extensions"][] = new \Twig_Extension_Debug();
    }

    $config["components"]["view"]["theme"] = [
        "pathMap" => [
            "@app/views" => [
                "@app/webapp/views",
                "@core/webapp/views",
            ],
        ]
    ];

    $config["components"]["assetManager"] = [
        "appendTimestamp" => true,
        "forceCopy"       => true,
        "beforeCopy"      => function ($in, $out) {
            return 0 !== strpos($in, '.') && (!file_exists($out) || filemtime($out) < filemtime($in));
        },
    ];

    $config["components"]["urlManager"] = [
        'enablePrettyUrl'     => true,
        'showScriptName'      => false,
        'enableStrictParsing' => true,

        "rules" => [
            "/" => $config["defaultRoute"],
        ],
    ];

    return $config;
};
