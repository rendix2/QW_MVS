<?php

include( './autoLoader.php' );
//include( './debug.php' );

use QW\FW\Paint\Point;

$img = new QW\FW\Images\Images( 400, 200 );
$img->setBackgroundColor( new \QW\FW\Paint\Color( 255, 255, 255 ) );
$img->setTextColor( new \QW\FW\Paint\Color( 0, 0, 0 ) );
$img->setText( 7, new Point( 100, 29 ), 'FUCK YOU!', FALSE );
$img->setText( 7, new Point( 100, 99 ), 'FUCK YOU!', FALSE );
$img->setText( 7, new Point( 80, 109 ), 'FUCK YOU!', TRUE );
$img->setText( 7, new Point( 180, 109 ), 'FUCK YOU!', TRUE );

for ( $i = 110; $i < 160; $i += 5 ) $img->setChar( 7, new Point( $i, 70 ), '!', FALSE );

$img->toPNG();
header( 'Content-Type: image/png' );