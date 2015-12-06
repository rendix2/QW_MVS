<?php
namespace QW\FW\DataStructures\Queue;

use QW\FW\Basic\Object;

class AbstractQueue extends Object {

	protected $size;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		$this->size = 0;
	}
}