<?php

namespace QW\FW\Boot;

class Router extends AbstractRouter {
	private $controller;
	private $method;
	private $params;

	public function __construct() {
		// init
		$this->controller = 'Index';
		$this->method     = 'index';
		$this->params     = [ ];

		//parent::__construct();


	}

	function __destruct() {
		$this->controller = NULL;
		$this->method     = NULL;
		$this->params     = NULL;

		parent::__destruct();
	}

	protected function loadMVP() {
	}

	protected final function loadMvc() {
		$url = $this->parseUrl();

		if ( empty( $url ) ) $url = $this->controller;

		//require_once('./QW/FW/Architecture/MVC/AbstractBasicController.php');
		//require_once('./QW/FW/Architecture/MVC/AbstractBasicModel.php');
		//require_once('./QW/FW/Architecture/MVC/BasicView.php');

		if ( file_exists( './QW/Controllers/' . $url[ 0 ] . 'Controller.php' ) ) {
			$this->controller = 'QW\\Controllers\\' . $url[ 0 ] . 'Controller';
			unset( $url[ 0 ] );

			echo $this->controller;
		}

		require_once( './QW/Controllers/' . $this->controller . 'Controller.php' );

		$this->controller = new $this->controller;

		if ( isset( $url[ 1 ] ) ) if ( $this->controller->methodExists( $url[ 1 ] ) ) {
			$this->method = $url[ 1 ];
			unset( $url[ 1 ] );
		}

		$this->params = $url ? array_values( $url ) : [ ];
		call_user_func_array( [ $this->controller, $this->method ], $this->params );
	}

	protected function loadMy() {
	}

	private function parseUrl() {
		if ( isset( $_GET[ 'url' ] ) ) return explode( '/',
			filter_var( rtrim( $_GET[ 'url' ], '/' ), FILTER_SANITIZE_URL ) );
	}
}