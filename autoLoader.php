<?php

mb_internal_encoding("UTF-8");

$load = function ($class) {

    if (strpos('Smarty', $class)) {
        require('/Smarty/Libs/Smarty.class.php');
        return 1;
    }

    $c = explode('\\', $class);
    $path = './' . implode('/', $c) . '.php';

    if (file_exists($path))
        require_once($path);
    else
        die('File: ' . $path . ' doesn\'t exists<br>');
    return 0;
};

try {
    spl_autoload_register($load);
} catch (Exception $e) {
    echo $e->getMessage() . 'adw';
}

?>