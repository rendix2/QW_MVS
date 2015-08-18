<?php
namespace QW\Controllers;

use QW\FW\Architecture\MVC\AbstractBasicController;
use QW\Libs\Config;

final class IndexController extends AbstractBasicController {

	public function __construct ( $name ) {
		parent::__construct( $name );

		$this->getView()
			->setPageName( "QW" );
	}

	public function __destruct () {
		echo 'destruct';
	}

	public function index () {
		$this->getView()
			->setTableData( $this->getModel()
			                     ->index() );
		$this->getView()
			->render( $this->getViewName() . Config::SLASH . 'index' );
	}
}