<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21. 6. 2015
 * Time: 18:33
 */

namespace QW\FW\DP\Builder;


class ShowOfUse {

	private $director;

	public function __construct() {
		$this->director = new Director();

		echo $this->director->build( new CheapBuilder() );
		echo $this->director->build( new LuxoryBuilder() );
	}

	public function __destruct() {
		$this->director = NULL;
	}
}