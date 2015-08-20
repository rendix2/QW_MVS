<?php

namespace QW\FW\Basic;

use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\MemberAccessException;

abstract class Object {
	private static $objectsCounter = 0;
	private static $methodCallCounter = 0;
	private static $methodStaticCallCounter = 0;
	private static $staticDebug = FALSE;
	private $debug;

	final public function __call( $name, $arguments ) {
		if ( $this->debug || self::$staticDebug ) echo $this->getClassName() . '::' . $name . '(' .
			explode( ',', $arguments ) . ')</b><br>';

		if ( !$this->methodExists( $name ) ) {
			throw new MemberAccessException( 'Non-existing method: <b> ' . $this->getClassName() . '</b>::<b>' . $name .
				'()<br>' );
		}

		self::callCounter();
	}

	final public static function __callStatic( $name, $arguments ) {
		self::debugStatic( $name, $arguments );

		if ( !self::methodExists( $name ) ) {
			throw new MemberAccessException( 'Non-existing method: ' . self::getStaticClassName() . '::' . $name .
				'()</b><br>' );
		}

		self::staticCallCounter();
	}

	final public function __clone() {
		throw new MemberAccessException();
	}

	public function __construct( $debug = FALSE ) {
		$this->debug = $debug;

		if ( self::$staticDebug == TRUE || $this->debug == TRUE || $debug == TRUE ) {
			self::$objectsCounter++;

			echo 'Creating instance of: <b>' . $this->getClassName() . '</b><br>';
		}
	}

	public function __destruct() {
		if ( $this->debug == TRUE || self::$staticDebug == TRUE ) echo 'Destroying instance of: <b>' .
			$this->getClassName() . '</b><br>';

		echo self::$objectsCounter . '<br>';

		if ( self::$objectsCounter > 0 ) self::$objectsCounter--;
		else throw new MemberAccessException( 'Too much objects destroyed. Something is wrong with your memory management. Maybe wrong destructors calling.<br>' );

		$this->debug = NULL;
	}


	final public function __get( $name ) {
		if ( !$this->propertyExists( $name ) ) throw new MemberAccessException( 'Non-existing property: <b>' .
			$this->getClassName() . '</b>-><b>' . (string) $name . '</b><br>' );
	}


	public function __toString() {
		return '<br>I am: <b>' . $this->getClassName() .
		'</b>. You didn\'t overwrite <b>toString()</b> method. This message is in <b>Object</b> class.<br>';
	}


	final public static function getMethodCallCounter() {
		return self::$methodCallCounter;
	}


	final public static function getMethodStaticCallCounter() {
		return self::$methodStaticCallCounter;
	}


	final public static function getObjectsCount() {
		return self::$objectsCounter;
	}

	final protected static function getStaticClassName() {
		$wholeName = explode( '\\', get_called_class() );

		return $wholeName[ count( $wholeName ) - 1 ];
	}

	final public static function setAllDebug( $debug ) {
		if ( !is_bool( $debug ) ) throw new IllegalArgumentException();

		self::$staticDebug = $debug;
	}


	final private function callCounter() {
		if ( $this->debug == TRUE || self::$staticDebug == TRUE ) self::$methodCallCounter++;
	}

	final protected function classExists( $class ) {
		return class_exists( (string) $class );
	}

	final private function debugStatic( $name, $arguments ) {
		if ( $this->debug == TRUE || self::$staticDebug == TRUE ) echo 'Static call of: <b>' .
			self::getStaticClassName() . '::' . $name . '(' . explode( ', ', $arguments ) . ')</b><br>';
	}

	public function equals( Object $object ) {
		return $this == $object;
	}

	final protected function getClassName() {
		$wholeName = explode( '\\', $this->getWholeClassName() );

		return $wholeName[ count( $wholeName ) - 1 ];
	}

	final protected function getExceptionName() {
		return $this->hasException() ? $this->getClassName() . 'Exception' : FALSE;
	}

	final private function getExecutionStack() {
		print_r( debug_backtrace() );
	}

	final protected function getInstance() {
		return $this;
	}

	final protected function getReflection() {
		return new \ReflectionClass( $this );
	}

	final protected function getWholeClassName() {
		return get_class( $this );
	}

	final protected function hasException() {
		return $this->classExists( $this->getClassName() . 'Exception' );
	}

	final protected function methodExists( $methodName ) {
		return method_exists( $this, (string) $methodName );
	}

	final protected function propertyExists( $propertyName ) {
		return property_exists( $this, (string) $propertyName );
	}

	final private function staticCallCounter() {
		if ( $this->debug == TRUE || self::$staticDebug == TRUE ) self::$methodStaticCallCounter++;
	}
}