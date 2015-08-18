<?php
namespace QW\Controllers;

use QW\FW\Architecture\MVC\AbstractBasicController;
use QW\Libs\Config;

final class ErrorController extends AbstractBasicController {
	public function __construct( $name ) {
		parent::__construct( $name );

		$this->getView()
			->setPageName( "Chyba" );
	}

	public function index() {
		return $this->getView()
			->render( $this->getViewName() . Config::SLASH . 'index' );
	}
}