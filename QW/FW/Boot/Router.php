<?php

namespace QW\FW\Boot;

class Router extends AbstractRouter {
	private $controller;
	private $method;
	private $params;

	public function __construct () {
		// init
		$this->controller = 'Index';
		$this->method     = 'index';
		$this->params     = [ ];

		parent::__construct();
	}

	protected function loadMVP () {
	}

	protected final function loadMvc () {
		$url = $this->parseUrl();

		if ( file_exists( './Controllers/' . $url[ 0 ] . '.php' ) ) {
			$this->controller = $url[ 0 ];
			unset( $url[ 0 ] );
		}

		require_once( './Controllers/' . $this->controller . '.php' );

		$this->controller = new $this->controller;

		if ( isset( $url[ 1 ] ) ) if ( $this->controller->methodExists( $url[ 1 ] ) ) {
			$this->method = $url[ 1 ];
			unset( $url[ 1 ] );
		}

		$this->params = $url ? array_values( $url ) : [ ];
		call_user_func_array( [ $this->controller, $this->method ], $this->params );
	}

	protected function loadMy () {
	}

	private function parseUrl () {
		if ( isset( $_GET[ 'url' ] ) ) return explode( '/',
			filter_var( rtrim( $_GET[ 'url' ], '/' ), FILTER_SANITIZE_URL ) );
	}
}