<?php

	namespace QW\FW\Basic;

	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Boot\NullPointerException;
	use QW\FW\Utils\Math\Math;
	use QW\FW\Validator;

	final class Boolean extends Object {
		const FALSE = FALSE;
		const TRUE  = TRUE;
		private $boolean;

		public function __construct ( $boolean ) {
			parent::__construct ();

			if ( !Validator::isBool ( $boolean ) ) throw new IllegalArgumentException();

			$this->boolean = $boolean;
		}

		public function __destruct () {
			$this->boolean = NULL;

			parent::__destruct ();
		}

		public function __toString () {
			return (string) $this->boolean;
		}

		public function equals ( Object $object ) {
			if ( $object instanceof Boolean ) {
				return $this->boolean == $object->boolean;
			}

			return FALSE;
		}

		public static function compare ( $x, $y ) {
			if ( !is_bool ( $x ) || !is_bool ( $y ) ) throw new IllegalArgumentException();

			return $x == $y;
		}

		public static function equalsBoolean ( Boolean $x = NULL, Boolean $y = NULL ) {
			if ( $x == NULL || $y == NULL ) throw new IllegalArgumentException();

			return $x->boolean == $y->boolean;
		}

		public static function randomBoolean () {
			return new Boolean( Math::randomBoolean () );
		}

		public function logAndBoolean ( Boolean $bool = NULL ) {
			if ( $bool == NULL ) throw new NullPointerException();

			return new Boolean( $this->boolean && $bool->boolean );
		}

		public function logORBoolean ( Boolean $bool = NULL ) {
			if ( $bool == NULL ) throw new NullPointerException();

			return new Boolean( $this->boolean || $bool->boolean );
		}

		public function logXorBoolean ( Boolean $bool = NULL ) {
			if ( $bool == NULL ) throw new NullPointerException();

			return new Boolean( $this->boolean ^ $bool->boolean );
		}

		public function neg () {
			return new Boolean( !$this->boolean );
		}
	}