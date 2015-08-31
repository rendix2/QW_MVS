<?php

namespace QW\FW\Search\StringSearch;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;

abstract class AbstractStringSearch extends Object {
	private $string;

	abstract public function search();

	public function __construct( $string, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_string( $string ) ) throw new IllegalArgumentException();

		$this->string = (string) $string;
	}
}