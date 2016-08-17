<?php
namespace core\common\helpers;

use Yii;

class AppManager
{
    protected static $nsMap = [
        "core" => "app",
    ];

    public static function getCustomAlias($alias)
    {
        foreach (static::$nsMap as $coreNs => $appNs) {
            if (!preg_match("~^@{$coreNs}(/.*|)$~", $alias, $matches)) {
                continue;
            }

            $appAlias = sprintf("@%s%s", $appNs, $matches[1]);

            if (false !== $appPath = Yii::getAlias($appAlias, false)) {
                return $appPath;
            }

            break;
        }

        return Yii::getAlias($alias);
    }

    public static function getCustomClass($className, $checkInheritance = true)
    {
        if (0 == strncmp($className, "\\", 1)) {
            $className = substr($className, 1);
        }

        foreach (static::$nsMap as $coreNs => $appNs) {
            if (0 !== strpos($className, "$coreNs\\")) {
                continue;
            }

            $appClass = substr_replace($className, $appNs, 0, strlen($coreNs));

            if (class_exists($appClass) && (!$checkInheritance || is_subclass_of($appClass, $className))) {
                return $appClass;
            }

            break;
        }

        return $className;
    }
}
