<?php

include('./autoLoader.php');
include('./debug.php');

use QW\FW\Forms\FomCreator\FormCreator;
use QW\FW\Singleton;

class MySingleton extends Singleton
{

    public function r()
    {
        echo 'da';
    }
}

//$z = MySingleton::getSingleton();

//$z->r();


$quickWeb = new \QW\Libs\Bootstrap();


$z = new FormCreator('POST', '');
$z->createSelect('Select')->addList()->addChoice();
$z->addSelect()

?>



