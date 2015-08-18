<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21. 6. 2015
 * Time: 18:25
 */

namespace QW\FW\DP\Builder;

class CheapBuilder implements Builder {

	private $result;

	public function __construct () {
		$this->result = new Building();
	}

	public function __destruct () {
		$this->result = NULL;
	}

	public function buildFloor () {
		$this->result->setFloor( "Laminate Floor" );

		return $this;
	}

	public function buildRoof () {
		$this->result->setRoof( "wooden roof" );

		return $this;
	}

	public function buildWalls () {
		$this->result->setWalls( "panel walls" );

		return $this;
	}

	public function getResult () {
		return $this->result;
	}

	public function startNew () {
		$this->result = new Building();

		return $this;
	}
}

