<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 14:50
 */

namespace QW\FW\DP\Strategy;


class TimesStrategy implements Strategy {

	public function multiply($a, $b) {
		return $a * $b;
	}
}