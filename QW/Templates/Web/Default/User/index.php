<?php

	use QW\FW\Utils\SuperGlobals\Post;
	use QW\FW\WebDesign\Forms\FormCreator\FormCreatorHTML4;

	$z = new FormCreatorHTML4( 'POST', '' );
	$z->addInputText ( 'name', 'jmeno' )
	  ->addInputPassword ( 'password' )
	  ->addInputSubmit ( 'd', 'Login!' )
	;

	echo $z;

	$z = NULL;
	echo Post::get ( 'password' );