<?php
include( './autoLoader.php' );
//include( './debug.php' );


$img = new QW\FW\Images\ImageTextGenerate( 400, 80 );
$img->setBackgroundColor( 255, 255, 255 );
$img->setTextColor( 255, 15, 25 );
$img->setText( 5, 0, 15, \QW\Libs\Config::EMAIL );
$img->toPNG();
header( 'Content-Type: image/png' );








