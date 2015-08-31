<?php
namespace QW\FW\Basic\Better;

use QW\FW\Basic\String;

class StringEntities extends String {

	public function __construct( $string = "", $debug = FALSE ) {
		parent::__construct( $string, $debug );
		$this->string = htmlspecialchars( $string, ENT_QUOTES );
	}
}