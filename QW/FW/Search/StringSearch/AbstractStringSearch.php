<?php

namespace QW\FW\Search\StringSearch;

use QW\FW\Basic\IllegalArgumentException;
use QW\FW\Basic\Object;

abstract class AbstractStringSearch extends Object {
	private $string;

	abstract public function search();

	public function __construct($string) {
		parent::__construct();

		if ( !is_string($string) ) throw new IllegalArgumentException();

		$this->string = (string) $string;
	}
}