<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21. 6. 2015
 * Time: 18:27
 */

namespace QW\FW\DP\Builder;


class LuxoryBuilder implements Builder
{

	private $result;

	public function __construct()
	{
		$this->result = new Building();
	}

	public function __destruct()
	{
		$this->result = NULL;
	}

	public function buildFloor()
	{
		$this->result->setFloor( "wooden floor" );

		return $this;
	}

	public function buildRoof()
	{
		$this->result->setRoof( "shindel roof" );

		return $this;
	}

	public function buildWalls()
	{
		$this->result->setWalls( "brick wall" );

		return $this;
	}

	public function getResult()
	{
		return $this->result;
	}
}