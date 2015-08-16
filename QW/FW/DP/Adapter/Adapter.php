<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19. 6. 2015
 * Time: 20:06
 */

namespace QW\FW\DP\Adapter;


class Adapter implements Target
{

	private $oldClass;

	public function __construct()
	{
		$this->oldClass = new OldClass();
	}


	public function newRequest()
	{
		return $this->oldClass->oldRequest();
	}
}