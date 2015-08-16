<?php

namespace QW\FW\Search\ArraySearch;

use QW\FW\Basic\Object;

abstract class AbstractArraySearch extends Object
{
	private $data;
	private $length;

	public function __construct( array $data )
	{
		parent::__construct();

		$this->data = $data;
		$this->length = count( $this->data );

		$this->search();
	}

	abstract public function search();
}