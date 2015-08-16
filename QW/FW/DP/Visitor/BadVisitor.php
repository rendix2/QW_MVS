<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 15:13
 */

namespace QW\FW\DP\Visitor;


class BadVisitor implements Visitor {

	public function __toString() {
		return 'Gauner';
	}

	public function visitCinema(Cinema $cinema) {
		echo $this . " Sežral popkorn vedlejšímu divákovi";
	}

	public function visitMuseum(Museum $museum) {
		echo $this . " Vypil kávu nočního hlíče, lotr jeden!";
	}
}