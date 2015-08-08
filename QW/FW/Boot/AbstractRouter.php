<?php

namespace QW\FW\Boot;

use QW\FW\Basic\Object;

abstract class AbstractRouter extends Object
{
    public function __construct() {
        parent::__construct();

        require_once('./Exception.php');

        $this->route();
    }

    protected final function route(){
        self::loadClass();
        $this->loadMVC();
        $this->loadMVP();
        $this->loadMy();
    }

    public static function loadClass(){
        mb_internal_encoding("UTF-8");

        $load = function ($class) {

            // don't load Controller or Model by this
            if (preg_match('#Controller|Model$#', $class))
                return 2;

            // manual Smarty load
            if (strpos('Smarty', $class)) {
                require('/Smarty/Libs/Smarty.class.php');
                return 2;
            }

            // parse namespace
            $c = explode('\\', $class);
            $path = './' . implode('/', $c) . '.php';

            // load class in namespace
            if (file_exists($path))
                require_once($path);
            else
                die('File: ' . $path . ' doesn\'t exists<br>');
            return 0;
        };

        try {
            spl_autoload_register($load);
        } catch (\Exception $e) {
            echo $e->getMessage() . 'adw';
        }
    }

    abstract protected function loadMVC();
    abstract protected function loadMVP();
    abstract protected function loadMy();
}