<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19. 6. 2015
 * Time: 19:53
 */

namespace QW\FW\DP\Command;


class PrintCommand implements Command {

	private $text;

	public function __construct( $text ) {
		$this->text = $text;
	}

	public function execute() {
		echo $this->text;
	}
}