<?php

namespace QW\FW\Forms;

use QW\FW\Basic\Object;

class Form extends Object {

	private $safeForm;

	public function __construct() {
		parent::__construct();
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