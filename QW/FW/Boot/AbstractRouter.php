<?php

namespace QW\FW\Boot;

use QW\FW\Basic\Object;
use QW\FW\Utils\Log\Logger;

abstract class AbstractRouter extends Object {
	public static $z;
	protected $g;

	abstract protected function loadMVC ();

	abstract protected function loadMVP ();

	abstract protected function loadMy ();

	public function __construct () {
		parent::__construct();

		require_once( './Exception.php' );
		require_once( './QW/Smarty/libs/Smarty.class.php' );
		$this->route();
	}

	public static function loadClass () {
		mb_internal_encoding( "UTF-8" );

		$load = function ( $class ) {

			// don't load Controller or Model by this
			if ( preg_match( '#Controller|Model$#', $class ) ) return -2;

			// manual Smarty load
			if ( strpos( 'Smarty', $class ) ) return -1;

			// parse namespace
			$c    = explode( '\\', $class );
			$path = './' . implode( '/', $c ) . '.php';

			// load class in namespace
			if ( file_exists( $path ) ) require_once( $path );
			else {
				$message = 'Error from ' . self::getStaticClassName() . ': File: ' . $path . ' doesn\'t exists<br>';

				$logger = new Logger( Logger::LOG_TYPE_FILE );
				$logger->log( $message );

				die( $message );
			}

			return 0;
		};

		try {
			spl_autoload_register( $load );
		}
		catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}

	protected final function route () {
		self::loadClass();
		$this->loadMVC();
		$this->loadMVP();
		$this->loadMy();
	}
}