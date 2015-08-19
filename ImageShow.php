<?php
include( './autoLoader.php' );
//include( './debug.php' );


$img = new QW\FW\Images\ImageTextGenerate( 200, 40 );
$img->setBackgroundColor( 255, 255, 255 );
$img->setTextColor( 255, 0, 0 );
$img->setText( 5, 0, 15, \QW\Libs\Config::EMAIL );
$img->toPNG();
header( 'Content-Type: image/png' );








