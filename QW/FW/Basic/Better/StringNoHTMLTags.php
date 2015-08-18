<?php

namespace QW\FW\Basic\Better;

use QW\FW\Basic\String;

class StringNoHTMLTags extends String {

	public function __construct ( $string = "" ) {
		parent::__construct( $string );
		$this->string = strip_tags( $string );
	}
}