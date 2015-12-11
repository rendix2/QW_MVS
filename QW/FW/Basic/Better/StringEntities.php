<?php
namespace QW\FW\Basic\Better;

use QW\FW\Basic\StringW;

class StringWEntities extends StringW {

	public function __construct( $string = "", $debug = FALSE ) {
		parent::__construct( $string, $debug );
		$this->string = htmlspecialchars( $string, ENT_QUOTES );
	}
}