<?php
namespace QW\Controllers;

use QW\FW\Architecture\MVC\AbstractBasicController;
use QW\FW\SuperGlobals\Session;
use QW\Libs\Config;

final class UserController extends AbstractBasicController {

	public function __construct( $name, $debug = FALSE ) {
		parent::__construct( $name, $debug );

		$this->getView()
			->setPageName( "Uživatel" );
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function delete() {
	}

	public function edit() {
	}

	public function index() {
		return $this->getView()
			->render( $this->getViewName() . Config::SLASH . 'index' );
	}

	public function login() {
		$this->getView()
		     ->render( $this->getViewName() . Config::SLASH . 'index' );
	}

	public function logout() {
		Session::end();
	}
}