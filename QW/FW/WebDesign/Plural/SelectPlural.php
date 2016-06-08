<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 7. 9. 2015
	 * Time: 16:28
	 */

	namespace QW\FW\WebDesign\Plural;

	final class SelectPlural extends AbstractPlural {

		public function __construct ( $lang, $count, $words ) {
			parent::__construct ();

			$lang = strtolower ( $lang );

			if ( $lang = 'cz' ) $this->plural = new CzechPlural( $count, $words );
			else $this->plural = new EnglishPlural( $count, $words );
		}
	}