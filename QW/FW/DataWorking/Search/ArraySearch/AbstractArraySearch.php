<?php

namespace QW\FW\DataWorking\Search\ArraySearch;

use QW\FW\Basic\Object;

abstract class AbstractArraySearch extends Object {
	protected $data;
	protected $length;
	protected $pattern;

	abstract public function search();

	public function __construct( array $data, $pattern, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->data   = $data;
		$this->length = count( $this->data );
		$this->pattern = $pattern;
		$this->search();
	}
}