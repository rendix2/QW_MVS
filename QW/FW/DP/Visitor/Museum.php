<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 15:09
 */

namespace QW\FW\DP\Visitor;


class Museum implements Place {

	public function accept(Visitor $visitor) {
		echo 'Do muzea šel: ' . $visitor;
		$visitor->visitMuseum($this);
	}

}