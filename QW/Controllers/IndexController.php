<?php
namespace QW\Controllers;

use QW\FW\Architecture\MVC\AbstractBasicController;
use QW\Libs\Config;

final class IndexController extends AbstractBasicController {

	public function __construct( $name, $debug = FALSE ) {
		parent::__construct( $name, $debug );

		$this->getView()
			->setPageName( "QW" );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function index() {
		$this->getView()
			->setTableData( $this->getModel()
			                     ->index() );
		$this->getView()
			->render( $this->getViewName() . Config::SLASH . 'index' );
	}
}