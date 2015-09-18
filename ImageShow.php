<?php
include( './autoLoader.php' );
//include( './debug.php' );


$img = new QW\FW\Images\ImageTextGenerate( 400, 200 );
$img->setBackgroundColor( 255, 255, 255 );
$img->setTextColor( 0, 0, 0 );
$img->setTextHorizontally( 7, 100, 29, 'FUCK YOU!' );
$img->setTextHorizontally( 7, 100, 99, 'FUCK YOU!' );
$img->setTextVertically( 7, 80, 109, 'FUCK YOU!' );
$img->setTextVertically( 7, 180, 109, 'FUCK YOU!' );

for ( $i = 110; $i < 160; $i += 5 ) $img->setCharHorizontally( 7, $i, 70, '!' );

$img->toPNG();
header( 'Content-Type: image/png' );