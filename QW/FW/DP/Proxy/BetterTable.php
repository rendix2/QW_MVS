<?php

namespace QW\FW\DP\Proxy;

class BetterTable implements Table
{

	private $easyTable;

	public function __construct( EasyTable $easyTable )
	{
		$this->easyTable = $easyTable;
	}

	public function read( $key )
	{
		if ( $this->canRead() ) $this->easyTable->read( $key ); else
			throw new \Exception( 'Access denied' );
	}

	private function canRead()
	{
		return TRUE;
	}

	public function write( $key, $value )
	{
		if ( $this->canWrite() ) $this->easyTable->write( $key, $value ); else
			throw new \Exception( 'Access denied' );
	}

	private function canWrite()
	{
		return FALSE;
	}
}