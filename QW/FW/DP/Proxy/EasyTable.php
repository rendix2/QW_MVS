<?php

namespace QW\FW\DP\Proxy;

class EasyTable implements Table
{

	private $array = [ ];

	public function read( $key )
	{
		return $this->array[ $key ];
	}

	public function write( $key, $value )
	{
		$this->array[ $key ] = $value;
	}
}