<?php
include( './autoLoader.php' );
//include( './debug.php' );


$img = new QW\FW\Images\ImageTextGenerate( 200, 40 );
$img->setBackgroundColor( 235, 235, 235 );
$img->setTextColor( 235, 4, 3 );
$img->setText( 5, 0, 15, \QW\Libs\Config::EMAIL );
$img->toPNG();
header( 'Content-Type: image/png' );








