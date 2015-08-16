<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 17. 7. 2015
 * Time: 14:20
 */


use QW\FW\Forms\FormCreator\FormCreatorHTML4;

$z = new FormCreatorHTML4('POST', '');
$z->createSelect('Select')
  ->addList()
  ->addChoice();
$z->addSelect()
  ->addTextArea('text')
  ->addInputText('ahoj', 'ahoj', 5, 50, 'off');