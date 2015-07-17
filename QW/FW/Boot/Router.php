<?php

namespace QW\FW\Boot;

use QW\FW\Basic\Object;

class Router extends Object
{

    protected $controller;
    protected $method;
    protected $params;

    public function __construct()
    {
        parent::__construct();
        // init
        $this->controller = 'Index';
        $this->method = 'index';
        $this->params = [];

        // load MVC components
        $this->loadMvc();

        // class autoloader
        $this->loadClass();
    }

    private function loadMvc()
    {
        $url = $this->parseUrl();

        if (file_exists('./Controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once('./Controllers/' . $this->controller . '.php');

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if ($this->controller->methodExists($url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    private function loadClass()
    {
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
}