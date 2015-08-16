<?php

namespace QW\FW\Boot;

use QW\Controllers\IndexController;
use QW\FW\Config;

final class BootstrapException extends \Exception
{
}

class Bootstrap extends AbstractRouter
{
	protected $url, $params, $controller;

	public function __construct()
	{
		parent::__construct();

		$this->setParams();

		try {
			if ( $this->noUrl() ) return FALSE;

			$this->loadController();
			$this->callControllerMethod();

		} catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function __destruct()
	{
		$this->params = NULL;
		$this->url = NULL;
		$this->controller = NULL;
	}

	protected function setParams()
	{
		$this->url = isset( $_GET[ 'URL' ] ) ? $_GET[ 'URL' ] : NULL;
		$this->params = rtrim( $this->url, Config::URL_DELIMITER );
		$this->params = explode( Config::URL_DELIMITER, $this->params );
	}

	protected function noUrl()
	{
		if ( empty( $this->url ) ) {
			$this->controller = new IndexController( 'IndexModel' );
			$this->controller->index();

			return TRUE;
		}

		return FALSE;
	}

	protected function loadController()
	{
		$c = "\\QW\\Controllers\\" . $this->params[ 0 ] . 'Controller';

		$this->controller = new $c( $this->params[ 0 ] . 'Model' );
	}

	protected function callControllerMethod()
	{
		if ( isset( $this->params[ 1 ] ) ) {
			if ( isset( $this->params[ 2 ] ) && isset( $this->params[ 1 ] ) && method_exists( $this->controller, $this->params[ 1 ] ) ) $this->controller->{$this->params[ 1 ]}( intval( $this->params[ 2 ] ) ); else if ( isset( $this->params[ 1 ] ) && method_exists( $this->controller, $this->params[ 1 ] ) ) $this->controller->{$this->params[ 1 ]}(); else
				throw new BootstrapException( 'Neexistující metoda <b>' . $this->params[ 1 ] . '</b> kontroleru: <b>' . $this->params[ 0 ] . '</b>' );
		} else
			$this->controller->index();
	}
}