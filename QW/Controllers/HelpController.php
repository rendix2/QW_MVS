<?php
namespace QW\Controllers;

use QW\FW\Architecture\MVC\AbstractBasicController;
use QW\Libs\Config;

final class HelpController extends AbstractBasicController
{
	public function __construct( $name )
	{
		parent::__construct( $name );

		$this->getView()->setPageName( "Nápověda" );
	}

	public function index()
	{
		return $this->getView()->render( $this->getViewName() . Config::SLASH . 'index' );
	}

	public function index2( $int )
	{
		return $this->getView()->render( $this->getViewName() . Config::SLASH . 'index' );
	}
}
