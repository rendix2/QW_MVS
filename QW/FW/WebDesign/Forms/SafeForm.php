<?php

namespace QW\FW\WebDesign\Forms;

use QW\FW\Basic\Object;
use QW\FW\Utils\Hash\Hash;

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