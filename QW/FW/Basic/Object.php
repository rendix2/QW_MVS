<?php

namespace QW\FW\Basic;

use QW\FW\Boot\MemberAccessException;

class Object
{
	private static $name;

	public function __construct()
	{
		self::$name = NULL;
	}

	public final static function __callStatic( $name, $arguments )
	{
		if ( !self::methodExists( $name ) ) throw new MemberAccessException( 'Non-existing method: ' . self::getStaticClassName() . '</b>::<b>' . $name . '</b>' );
	}

	final protected function methodExists( $methodName )
	{
		return method_exists( $this, $methodName );
	}

	protected static function getStaticClassName()
	{
		$wholeName = explode( '\\', get_called_class() );

		return $wholeName[ count( $wholeName ) - 1 ];
	}

	public final function __call( $name, $arguments )
	{
		if ( !$this->methodExists( $name ) ) throw new MemberAccessException( 'Non-existing method: <b>' . $this->getClassName() . '</b>::<b>' . $name . '</b>' );
	}

	final protected function getClassName()
	{
		$wholeName = explode( '\\', $this->getWholeClassName() );

		return $wholeName[ count( $wholeName ) - 1 ];
	}

	final protected function getWholeClassName()
	{
		return get_class( $this );
	}

	public final function __get( $name )
	{
		if ( !$this->propertyExists( $name ) ) throw new MemberAccessException( 'Non-existing property: <b>' . $this->getClassName() . '</b>-><b>' . $name . '</b>' );
	}

	final protected function propertyExists( $propertyName )
	{
		return property_exists( $this, $propertyName );
	}

	public function __destruct()
	{
		self::$name = NULL;
	}

	public function __toString()
	{
		return '<br>I am: class: <b>' . $this->getClassName() . '</b>. You didn\'t overwrite <b>toString()</b> method.<br>';
	}

	public function equals( Object $object )
	{
		return $this == $object;
	}

	final protected function getExceptionName()
	{
		return $this->hasException() ? $this->getClassName() . 'Exception' : FALSE;
	}

	final protected function hasException()
	{
		return $this->classExists( $this->getClassName() . 'Exception' );
	}

	final protected function classExists( $class )
	{
		return class_exists( $class );
	}

	final protected function getInstance()
	{
		return $this;
	}

	protected function getReflection()
	{
		return new \ReflectionClass( $this );
	}
}