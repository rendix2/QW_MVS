<?php
namespace QW\FW\Utils\Math;

use QW\FW\Boot\PrivateConstructException;

final class MathEquation {
	public function __construct() {
		throw new PrivateConstructException();
	}

	/*
	* Kvadraticka rovnice o jedne nezname ve tvaru ax^2 + bx + c = 0
	* @param $a
	* @param $b
	* @param $c
	* @return pole realnych korenu, NULL - pokud nema rovnice reseni v oboru realnych cisel
	* @author Thomas (www.adamjak.net)
	* http://www.algoritmy.net/article/1538/Kvadraticka-rovnice
	*/

	public static function solve_quadratic_equation( $a, $b, $c ) {
		$d = $b * $b - 4 * $a * $c; // diskriminant

		if ( $d < 0 ) return NULL;
		else if ( $d == 0 || $a == 0 ) return ( -$b / 2 * $a );
		else return ( ( -$b + Math::squareRoot( $d ) ) / ( 2 * $a ) . ( -$b - Math::squareRoot( $d ) ) / ( 2 * $a ) );
	}
}