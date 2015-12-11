<?php

namespace QW\FW\Boot;

use QW\FW\Basic\Object;

abstract class AbstractRouter extends Object {

	private static $logger;

	abstract protected function loadMVC();

	abstract protected function loadMVP();

	abstract protected function loadMy();

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		require_once( './QW/FW/Boot/Exceptions.php' );
		//self::$logger = new Logger( Logger::LOG_TYPE_GLOBAL, $debug );

		$this->setAllDebug( $debug );
		//require_once( './QW/FW/Boot/Exceptions.php' );
		require_once( './QW/Smarty/libs/Smarty.class.php' );
		$this->route();
	}

	public function __destruct() {
		parent::__destruct();
	}

	final public static function getGlobalLogger() {
		return self::$logger;
	}

	public static function loadClass() {
		mb_internal_encoding( "UTF-8" );

		$load = function ( $class ) {

			if ( AbstractRouter::getAllDebug() ) echo 'Loading class: <b>' . $class . '</b><br>';

			// don't load Controller or Model by this
			//if ( preg_match( '#Controller|Model$#', $class ) ) return -2;
			// manual Smarty load
			if ( preg_match( '#Smarty#', $class ) ) return -3;
			if ( strpos( 'Smarty', $class ) ) return -1;

			// parse namespace

			$c                = explode( '\\', $class );
			$count            = count( $c );
			$pathToFile       = './' . implode( '/', $c ) . '.php';
			$pathToDir        = './' . implode( '/', array_slice( $c, $count - 1 ) );
			$pathToExceptions = $pathToDir . '/Exceptions.php';

			if ( file_exists( $pathToExceptions ) ) require_once( $pathToExceptions );

			// load class in namespace
			if ( file_exists( $pathToFile ) ) require_once( $pathToFile );
			else {
				$message =
					'Error from ' . self::getStaticClassName() . ': File: ' . $pathToFile . ' doesn\'t exists<br>';

				//$logger = new Logger( Logger::LOG_TYPE_FILE );
				//$logger->log( $message );

				//self::getExecutionStack();

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
