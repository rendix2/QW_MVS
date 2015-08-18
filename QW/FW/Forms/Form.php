<?php

namespace QW\FW\Forms;

use QW\FW\Basic\Object;

class Form extends Object {

	private $safeForm;

	public function __construct () {
		parent::__construct();
		$this->safeForm = new SafeForm();
	}

	public function getSafeForm () {
		return $this->safeForm;
	}
}