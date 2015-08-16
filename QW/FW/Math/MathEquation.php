<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 12. 6. 2015
 * Time: 16:17
 */

namespace QW\FW\Math;


final class MathEquation
{
	private static function __construct()
	{
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
	public static function solve_quadratic_equation( $a, $b, $c )
	{
		$d = $b * $b - 4 * $a * $c; // diskriminant

		if ( $d < 0 ) {
			return NULL;
		} else if ( $d == 0 ) {
			$result = ( -$b / 2 * $a );

			return $result;
		} else {
			$result = ( ( -$b + sqrt( $d ) ) / ( 2 * $a ) . ( -$b - sqrt( $d ) ) / ( 2 * $a ) );

			return $result;
		}
	}
}