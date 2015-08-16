<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 14:51
 */

namespace QW\FW\DP\Strategy;


use QW\FW\Math\Math;

class PlusStrategy implements Strategy {

	public function multiply($a, $b) {
		$times = Math::absoluteValue($b);

		for ( $i = 0; $i < $times; $i++ ) {
			$a += $a;
		}

		return $b > 0 ? $a : -$a;
	}
}