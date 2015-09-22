<?php

include( './autoLoader.php' );
//include( './debug.php' );

use QW\FW\Paint\Point;

$img = new QW\FW\Images\Images( 400, 200 );
$img->setBackgroundColor( 255, 255, 255 );
$img->setTextColor( 0, 0, 0 );
$img->setTextHorizontally( 7, new Point( 100, 29 ), 'FUCK YOU!' );
$img->setTextHorizontally( 7, new Point( 100, 99 ), 'FUCK YOU!' );
$img->setTextVertically( 7, new Point( 80, 109 ), 'FUCK YOU!' );
$img->setTextVertically( 7, new Point( 180, 109 ), 'FUCK YOU!' );

for ( $i = 110; $i < 160; $i += 5 ) $img->setCharHorizontally( 7, new Point( $i, 70 ), '!' );

$img->toPNG();
header( 'Content-Type: image/png' );