<?php
namespace QW\Controllers;

use QW\FW\Architecture\MVC\AbstractBasicController;
use QW\FW\SuperGlobals\Session;
use QW\Libs\Config;

final class UserController extends AbstractBasicController
{
	public function __construct( $name )
	{
		parent::__construct( $name );

		$this->getView()->setPageName( "Uživatel" );
	}

	public function login()
	{
	}

	public function logout()
	{
		Session::end();
	}

	public function edit()
	{
	}

	public function delete()
	{
	}

	public function index()
	{
		return $this->getView()->render( $this->getViewName() . Config::SLASH . 'index' );
	}
}