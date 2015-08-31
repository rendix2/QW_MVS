<?php

namespace QW\FW\Boot;

use QW\FW\Boot;
use QW\FW\Config;

class BetterBootstrap extends AbstractRouter {
	private $enabledRoutes;
	private $urlDelimiter;

	public function __construct( $urlDelimiter = Config::URL_DELIMITER, $debug = FALSE ) {
		$this->$urlDelimiter = $urlDelimiter;
		$this->enabledRoutes = [ ];

		parent::__construct( $debug );
	}

	public function __destruct() {
		$this->enabledRoutes = NULL;
		$this->urlDelimiter  = NULL;

		parent::__destruct();
	}

	public function addRoute( $route ) {
		$this->enabledRoutes[] = $route;
	}

	protected function callControllerMethod() {
		if ( in_array( $this->params[ 0 ], $this->enabledRoutes ) ) $this->callControllerMethod();
		else throw new IllegalArgumentException();
	}

	protected function loadMVC() {
		// TODO: Implement loadMVC() method.
	}

	protected function loadMVP() {
		// TODO: Implement loadMVP() method.
	}

	protected function loadMy() {
		// TODO: Implement loadMy() method.
	}

	protected function setParams() {
		$this->url    = isset( $_GET[ 'URL' ] ) ? $_GET[ 'URL' ] : NULL;
		$this->params = rtrim( $this->url, $this->$urlDelimiter );
		$this->params = explode( $this->$urlDelimiter, $this->params );
	}
}