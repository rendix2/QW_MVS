<?php

namespace QW\FW\SuperGlobals;

use QW\FW\Interfaces\ISG;

class Get implements ISG
{
    private static function __construct()
    {
    }

    public static function set($k, $v)
    {
        $_GET[$k] = $v;

        return (self::get($k) == $v) ? true : false;
    }

    public static function get($k)
    {
        return isset($_GET[$k]) ? $_GET[$k] : false;
    }

    public static function getAll()
    {
        return $_GET;
    }
}