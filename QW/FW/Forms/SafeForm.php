<?php

namespace QW\FW\Forms;

use QW\FW\Basic\Object;
use QW\FW\Hash;

final class SafeForm extends Object {

	private $hash;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		$this->hash = Hash::r();
	}

	public function __destruct() {
		$this->hash = NULL;
		parent::__destruct();
	}
}