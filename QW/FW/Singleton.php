<?php

namespace QW\FW;

use QW\FW\Basic\Object;
use QW\FW\Interfaces\ISingleton;

abstract class Singleton extends Object implements ISingleton
{
    protected static $instance;

    public final function __construct()
    {
        self::$instance = null;
    }

    public static final function getSingleton()
    {
        if (self::$instance == null) {
            $className = self::getStaticClassName();
            self::$instance = new $className();
        }

        return self::$instance;
    }
}
