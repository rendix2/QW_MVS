<?php
include( './autoLoader.php' );
//include( './debug.php' );


$img = new QW\FW\Images\ImageTextGenerate( 400, 80 );
$img->setBackgroundColor( 255, 255, 255 );
$img->setTextColor( 255, 15, 25 );
//$img->setText( 7, 100, 30, 'FUCK YOU!' );
$img->s
//$img->setTextVertically(7, 100, 30, 'FUCK YOU!');
$img->toPNG();
header( 'Content-Type: image/png' );








