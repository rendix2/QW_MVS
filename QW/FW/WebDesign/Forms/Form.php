<?php

namespace QW\FW\WebDesign\Forms;

use QW\FW\Basic\Object;

class Form extends Object {

	private $safeForm;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		$this->safeForm = new SafeForm();
	}

	public function __destruct() {
		$this->safeForm = NULL;
		parent::__destruct();
	}

	public function getSafeForm() {
		return $this->safeForm;
	}
}