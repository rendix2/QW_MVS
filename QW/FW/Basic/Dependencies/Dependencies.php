<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 9. 6. 2016
	 * Time: 1:30
	 */

	namespace QW\FW\Basic\Dependencies;

	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Validator;

	class Dependencies {

		private $depends;

		public function __construct ( $depends = NULL ) {
			if ( $depends != NULL )
				$this->setDepend ( $depends );
		}

		public function __destruct () {
			$this->depends = NULL;
		}

		public static function validateDepend ( $depends ) {
			if ( !Validator::isArray ( $depends ) || !Validator::isObject ( $depends ) ) throw  new IllegalArgumentException();
		}

		public function addDepend ( $depends ) {
			self::addDepend ( $depends );
			$this->depends[] = $depends;

			return $this;
		}

		public function getDependByClass ( $name ) {
			foreach ( $this->depends as $dep )
				if ( $dep instanceof $name ) return $dep;

			return NULL;
		}

		public function getDependById ( $id ) {
			return isset( $this->depends[ $id ] ) ? $this->depends[ $id ] : NULL;
		}

		public function setDepend ( $depends ) {
			self::validateDepend ( $depends );
			$this->depends = $depends;

			return $this;
		}
	}