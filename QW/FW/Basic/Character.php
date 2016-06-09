<?php

	namespace QW\FW\Basic;

	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Validator;

	class Character extends Object {

		private $char;

		public function __construct ( $char = '' ) {
			parent::__construct ();

			if ( !Validator::isChar ( $char ) ) throw new IllegalArgumentException();

			$this->char = $char;
		}

		public function __destruct () {
			$this->char = NULL;

			parent::__destruct ();
		}

		public function __toString () {
			return $this->char;
		}

		public function equals ( Object $object ) {
			if ( $object instanceof Character ) {
				return $this->char == $object->char;
			}

			return FALSE;
		}

		public function equalsCharacter ( Character $character = NULL ) {
			if ( $character == NULL ) throw new IllegalArgumentException();

			return $this->char == $character->char;
		}

		public function toASCII () {
			return ord ( $this->char );
		}
	}