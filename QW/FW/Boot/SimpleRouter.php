<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 6. 12. 2015
	 * Time: 14:55
	 */

	namespace QW\FW\Boot;


	use QW\FW\Utils\SuperGlobals\Get;

	class SimpleRouter extends AbstractRouter {

		function __construct ( $urlName ) {
			parent::__construct ();

			if ( isset( Get::get ( $urlName ) ) ) require ( "./QW/Controllers/" . Get::get ( $urlName ) . ".php" );
			else throw new IllegalArgumentException();
		}

		protected function loadMVC () {
			// TODO: Implement loadMVC() method.
		}

		protected function loadMVP () {
			// TODO: Implement loadMVP() method.
		}

		protected function loadMy () {
			// TODO: Implement loadMy() method.
		}
	}