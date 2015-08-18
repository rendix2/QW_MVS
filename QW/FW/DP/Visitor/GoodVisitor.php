<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 15:10
 */

namespace QW\FW\DP\Visitor;


class GoodVisitor implements Visitor {

	function __toString() {
		return 'Hodný návštěvník';
	}

	public function visitCinema( Cinema $cinema ) {
		echo $this . " Je v kině";
	}

	public function visitMuseum( Museum $museum ) {
		echo $this . " Je v muzeu";
	}
}