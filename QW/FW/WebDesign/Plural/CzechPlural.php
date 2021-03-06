<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 7. 9. 2015
	 * Time: 15:56
	 */

	namespace QW\FW\WebDesign\Plural;

	use QW\FW\Boot\IllegalArgumentException;

	final class CzechPlural extends AbstractPlural {

		public function __construct ( $count, $words ) {
			parent::__construct ();

			if ( count ( $words ) != 3 ) throw new IllegalArgumentException();
			if ( $count == 1 ) $this->plural = $words[ 0 ];
			else if ( $count > 1 && $count < 5 ) $this->plural = $words[ 1 ];
			else if ( $count >= 5 ) $this->plural = $words[ 2 ];
		}
	}