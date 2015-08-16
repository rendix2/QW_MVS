<?php

namespace QW\FW\Boot;

use QW\FW\Boot;
use QW\FW\Config;

class BetterBootstrap extends AbstractRouter
{
	private $enabledRoutes;
	private $urlDelimiter;

	public function __construct( $urlDelimiter = Config::URL_DELIMITER )
	{
		$this->$urlDelimiter = $urlDelimiter;
		$this->enabledRoutes = [ ];

		parent::__construct();
	}

	public function addRoute( $route )
	{
		$this->enabledRoutes[] = $route;
	}


	protected function setParams()
	{
		$this->url = isset( $_GET[ 'URL' ] ) ? $_GET[ 'URL' ] : NULL;
		$this->params = rtrim( $this->url, $this->$urlDelimiter );
		$this->params = explode( $this->$urlDelimiter, $this->params );
	}

	protected function callControllerMethod()
	{
		if ( in_array( $this->params[ 0 ], $this->enabledRoutes ) ) {
			$this->callControllerMethod();
		} else {
			throw new IllegalArgumentException();
		}
	}

}