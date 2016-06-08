<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 8. 6. 2016
	 * Time: 22:26
	 */

	namespace QW\FW\Basic;

	use QW\FW\Boot\IllegalArgumentException;

	class Debug extends Object {

		private $debug;

		public function __construct ( $debug ) {
			if ( !is_bool ( $debug ) ) throw new IllegalArgumentException();
			$this->debug = $debug;
		}

		final public function getDebug () {
			return $this->debug;
		}
	}