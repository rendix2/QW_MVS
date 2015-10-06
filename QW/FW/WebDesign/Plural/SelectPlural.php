<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 7. 9. 2015
 * Time: 16:28
 */

namespace QW\FW\WebDesign\Plural;

final class SelectPlural extends AbstractPlural {

	public function __construct( $lang, $count, $words, $debug = FALSE ) {
		parent::__construct( $debug );

		$lang = strtolower( $lang );

		if ( $lang = 'cz' ) $this->plural = new CzechPlural( $count, $words, $debug );
		else $this->plural = new EnglishPlural( $count, $words, $debug );
	}
}