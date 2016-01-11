<?php

namespace QW\FW\DP\Strategy;

use QW\FW\Utils\Math\Math;

class PlusStrategy implements Strategy {

	public function multiply( $a, $b ) {
		$times = Math::absSystem( $b );

		for ( $i = 0; $i < $times; $i++ ) $a += $a;

		return $b > 0 ? $a : -$a;
	}
}