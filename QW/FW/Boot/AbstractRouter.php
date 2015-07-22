<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 22. 7. 2015
 * Time: 17:22
 */

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