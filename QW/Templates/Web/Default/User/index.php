<?php

use QW\FW\Forms\FormCreator\FormCreatorHTML4;

$z = new FormCreatorHTML4( 'POST', '' );
$z->addInputText( 'name', 'jmeno' )
  ->addInputPassword( 'password' )
  ->addInputSubmit( 'd', 'submit' );

echo $z;

echo \QW\FW\SuperGlobals\Post::get( 'password' );