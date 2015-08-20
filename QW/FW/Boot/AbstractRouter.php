<?php

namespace QW\FW\Boot;

use QW\FW\Basic\Object;

abstract class AbstractRouter extends Object {

	abstract protected function loadMVC();

	abstract protected function loadMVP();

	abstract protected function loadMy();

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );

		require_once( './QW/FW/Boot/Exception.php' );
		require_once( './QW/Smarty/libs/Smarty.class.php' );
		$this->route();

		if ( $debug == TRUE ) $this->startDebug();
		else $this->stopDebug();
	}

	public static function loadClass() {
		mb_internal_encoding( "UTF-8" );

		$load = function ( $class ) {

			// don't load Controller or Model by this
			//if ( preg_match( '#Controller|Model$#', $class ) ) return -2;

			// manual Smarty load
			if ( preg_match( '#Smarty#', $class ) ) return -3;

			if ( strpos( 'Smarty', $class ) ) return -1;

			// parse namespace
			$c    = explode( '\\', $class );
			$path = './' . implode( '/', $c ) . '.php';

			// load class in namespace
			if ( file_exists( $path ) ) require_once( $path );
			else {
				$message = 'Error from ' . self::getStaticClassName() . ': File: ' . $path . ' doesn\'t exists<br>';

				//$logger = new Logger( Logger::LOG_TYPE_FILE );
				//$logger->log( $message );

				die( $message );
			}

			return 0;
		};

		try {
			spl_autoload_register( $load, TRUE );
		}
		catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}

	protected final function route() {
		self::loadClass();
		$this->loadMVC();
		$this->loadMVP();
		$this->loadMy();
	}
}