<?php

	namespace QW\FW\DataWorking\Search\StringSearch;

	use QW\FW\Basic\Object;
	use QW\FW\Basic\StringW;
	use QW\FW\Boot\IllegalArgumentException;

	abstract class AbstractStringSearch extends Object {
		protected $string;
		protected $pattern;

		abstract public function search ();

		public function __construct ( $string, $pattern ) {
			parent::__construct ();

			if ( !is_string ( $string ) ) throw new IllegalArgumentException();

			$this->string  = new StringW( $string );
			$this->pattern = new StringW( $pattern );
		}
	}