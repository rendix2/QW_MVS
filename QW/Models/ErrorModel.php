<?php
namespace QW\Models;

use QW\FW\Architecture\MVC\AbstractBasicModel;

final class ErrorModel extends AbstractBasicModel {

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function index() {
	}
}