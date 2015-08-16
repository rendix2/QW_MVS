<?php
namespace QW\FW\Basic\Better;

use QW\FW\Basic\String;

class StringEntities extends String {

	public function __construct($string = "") {
		parent::__construct($string);
		$this->string = htmlspecialchars($string, ENT_QUOTES);
	}
}