<?php

namespace QW\FW\DataWorking\Search\ArraySearch;

use QW\FW\Basic\Object;

abstract class AbstractArraySearch extends Object {
	private $data;
	private $length;

	abstract public function search();

	public function __construct( array $data, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->data   = $data;
		$this->length = count( $this->data );

		$this->search();
	}
}