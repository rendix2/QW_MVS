<?php

namespace QW\FW\Forms;

use QW\FW\Basic\Object;

final class SafeForm extends Object {

	private $hash;

	public function __construct() {
		parent::__construct();
		$this->hash = md5( uniqid() );
	}
}