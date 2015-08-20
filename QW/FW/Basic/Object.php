<?php

namespace QW\FW\Basic;

use QW\FW\Boot\MemberAccessException;

abstract class Object {
	private static $name;

	final public function __call( $name, $arguments ) {
		if ( !$this->methodExists( $name ) ) {
			$message = 'Non-existing method: <b> ' . $this->getClassName() . '</b>::<b>' . (string) $name . '</b>';
			$message .= ' with arguments: <b>' . explode( ', ', $arguments ) . '</b><br>';

			throw new MemberAccessException( $message );
		}
	}

	final public static function __callStatic( $name, $arguments ) {
		if ( !self::methodExists( $name ) ) {
			$message = 'Non-existing method: ' . self::getStaticClassName() . '</b>::<b>' . (string) $name . '</b>';
			$message .= ' with arguments: <b>' . explode( ', ', $arguments ) . '</b><br>';

			throw new MemberAccessException( $message );
		}
	}

	final public function __clone() {
		throw new MemberAccessException();
	}

	public function __construct() {
		self::$name = NULL;
	}

	public function __destruct() {
		self::$name = NULL;
	}

	public final function __get( $name ) {
		if ( !$this->propertyExists( $name ) ) throw new MemberAccessException( 'Non-existing property: <b>' .
			$this->getClassName() . '</b>-><b>' . (string) $name . '</b>' );
	}

	public function __toString() {
		return '<br>I am: <b>' . $this->getClassName() .
		'</b>. You didn\'t overwrite <b>toString()</b> method. This message is in <b>Object</b> class<br>';
	}

	final protected static function getStaticClassName() {
		$wholeName = explode( '\\', get_called_class() );

		return $wholeName[ count( $wholeName ) - 1 ];
	}

	final protected function classExists( $class ) {
		return class_exists( (string) $class );
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

	private final function getExecutionStack() {
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
}