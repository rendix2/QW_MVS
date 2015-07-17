<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Interfaces\ISG;

final class Cookie implements ISG
{
    private function __construct()
    {
    }

    public static function set($k, $v)
    {
        return setcookie($k, $v);
    }

    public static function get($k)
    {
        return isset($_COOKIE[$k]) ? $_COOKIE[$k] : false;
    }

    public static function getAll()
    {
        return $_COOKIE;
    }
}