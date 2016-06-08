<?php
	/**
	 * Created by PhpStorm.
	 * User: Tomáš
	 * Date: 7. 9. 2015
	 * Time: 16:21
	 */

	namespace QW\FW\WebDesign\Plural;

	final class EnglishPlural extends AbstractPlural {

		public function __construct ( $count, $word ) {
			parent::__construct ();

			if ( $count == 1 ) $this->plural = $word;
			else $this->plural = $word . 's';
		}
	}