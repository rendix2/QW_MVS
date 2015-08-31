<?php

namespace QW\FW\Forms;

use QW\FW\Basic\Object;

final class SafeForm extends Object {

	private $hash;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		$this->hash = md5( uniqid() );
	}

	public function __destruct() {
		$this->hash = NULL;
		parent::__destruct();
	}
}