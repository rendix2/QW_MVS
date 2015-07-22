<?php

namespace QW\FW\Boot;

use QW\FW\Basic\Object;

abstract class AbstractRouter extends Object
{
    public function __construct() {
        parent::__construct();

        $this->loadException();
    }

    public function loadException(){
        require_once('Exception.php');
    }
}