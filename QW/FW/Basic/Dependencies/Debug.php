<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 8. 6. 2016
	 * Time: 22:26
	 */

	namespace QW\FW\Basic\Dependencies;

	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Validator;

	class Debug {

		private $debug;

		public function __construct ( $debug ) {
			if ( !Validator::isBool ( $debug ) ) throw new IllegalArgumentException();
			$this->debug = $debug;
		}

		final public function getDebug () {
			return $this->debug;
		}
	}