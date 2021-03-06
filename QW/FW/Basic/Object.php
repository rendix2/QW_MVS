<?php
	/*
	 *  Tom, CTU FEE 2015
	 *
	 *  Petra, FB 2015, "jen píšu, abys tam nebylo nic :D"
	 *          "*aby"
	 */

	namespace QW\FW\Basic;

	use QW\FW\Basic\Dependencies\Debug;
	use QW\FW\Basic\Dependencies\Dependencies;
	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Boot\MemberAccessException;

	abstract class Object {
		const BACKSLASH = "\\";
		const DOT       = '.';
		const SLASH     = "/";
		private static $objectsCounter          = 0;
		private static $methodCallCounter       = 0;
		private static $methodStaticCallCounter = 0;
		private static $staticDebug             = FALSE;
		protected      $debug;
		private        $dependencies;
		private        $ds;

		final public function __call ( $name, $arguments ) {
			if ( $this->debug->getDebug () == TRUE || self::$staticDebug == TRUE ) echo 'Invalid method calling:' .
			$this->getClassName () .
			'::' .
			$name . '(' . implode ( $arguments, ', ' ) . ')<br>';

			if ( !$this->methodExists ( $name ) ) {
				throw new MemberAccessException( 'Invalid method calling: ' . $this->getClassName () . '::' . $name .
				'()<br>' );
			}

			self::callCounter ();
		}

		final public static function __callStatic ( $name, $arguments ) {
			self::debugStatic ( $name, $arguments );

			if ( !self::methodExists ( $name ) ) {
				throw new MemberAccessException( 'Non-existing method: ' . self::getStaticClassName () . '::' . $name .
				'()</b><br>' );
			}

			self::staticCallCounter ();
		}

		final public function __clone () {
			throw new MemberAccessException();
		}

		public function __construct () {
			$this->dependencies = new Dependencies();
			$this->dependencies->addDepend ( new Debug( FALSE ) );

			if ( $this->dependencies->getDependById ( 0 )->getDebug () == TRUE || self::$staticDebug == TRUE ) {
				self::$objectsCounter++;

				echo 'Creating instance of: <b>' . $this->getClassName () . '</b><br>';
			}
			$this->ds = $ds;
		}

		public function __destruct () {
			if ( $this->debug->getDebug () == TRUE || self::$staticDebug == TRUE ) echo 'Destroying instance of: <b>' .
			$this->getClassName () . '</b><br>';

			if ( self::$staticDebug == TRUE && self::$objectsCounter > 0 ) self::$objectsCounter--;
			else if ( self::$staticDebug == TRUE &&
			self::$objectsCounter < 0
			) throw new MemberAccessException( 'Too much objects destroyed. Something is wrong with your memory management. Maybe wrong destructors calling.<br>' );

			$this->debug = NULL;
		}

		final public function __get ( $name ) {
			if ( !$this->propertyExists ( $name ) ) throw new MemberAccessException( 'Non-existing property: <b>' .
			$this->getClassName () . '</b>::$<b>' . (string) $name . '</b><br>' );
		}

		public function __toString () {
			return '<br>I am: <b>' . $this->getClassName () .
			'</b>. You didn\'t overwrite <b>toString()</b> method. This message is in <b>Object</b> class.<br>';
		}

		final public static function getAllDebug () {
			return self::$staticDebug;
		}

		final public static function getMethodCallCounter () {
			return self::$methodCallCounter;
		}

		final public static function getMethodStaticCallCounter () {
			return self::$methodStaticCallCounter;
		}

		final public static function getObjectsCount () {
			return self::$objectsCounter;
		}

		final protected static function getStaticClassName () {
			$wholeName = explode ( self::BACKSLASH, get_called_class () );

			return $wholeName[ count ( $wholeName ) - 1 ];
		}

		final public static function setAllDebug ( $debug = FALSE ) {
			if ( !is_bool ( $debug ) ) throw new IllegalArgumentException();

			self::$staticDebug = $debug;
		}

		final private function callCounter () {
			if ( $this->debug->getDebug () == TRUE || self::$staticDebug == TRUE ) self::$methodCallCounter++;
		}

		final protected function classExists ( $class ) {
			return class_exists ( (string) $class );
		}

		final private function debugStatic ( $name, $arguments ) {
			if ( $this->debug->getDebug () == TRUE || self::$staticDebug == TRUE ) echo 'Static call of: <b>' .
			self::getStaticClassName () . '::' . $name . '(' . implode ( $arguments, ', ' ) . ')</b><br>';
		}

		public function equals ( Object $object ) {
			return $this == $object;
		}

		final protected function getClassName () {
			$wholeName = explode ( self::BACKSLASH, $this->getWholeClassName () );

			return $wholeName[ count ( $wholeName ) - 1 ];
		}

		public function getDebug () {
			return $this->debug;
		}

		final public function setDebug ( $debug ) {
			if ( !is_bool ( $debug ) ) throw new IllegalArgumentException();
			$this->debug = new Debug( $debug );
		}

		final protected function getExceptionName () {
			return $this->hasException () ? $this->getClassName () . 'Exception' : FALSE;
		}

		final protected function getExecutionStack () {
			print_r ( debug_backtrace () );
		}

		final protected function getInstance () {
			return $this;
		}

		final protected function getReflection () {
			return new \ReflectionClass( $this );
		}

		final protected function getWholeClassName () {
			return get_class ( $this );
		}

		final protected function hasException () {
			return $this->classExists ( $this->getClassName () . 'Exception' );
		}

		final protected function methodExists ( $methodName ) {
			return method_exists ( $this, (string) $methodName );
		}

		final protected function propertyExists ( $propertyName ) {
			return property_exists ( $this, (string) $propertyName );
		}

		final private function staticCallCounter () {
			if ( $this->debug->getDebug () == TRUE || self::$staticDebug == TRUE ) self::$methodStaticCallCounter++;
		}
	}