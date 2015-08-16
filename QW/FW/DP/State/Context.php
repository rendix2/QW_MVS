<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 12:24
 */

namespace QW\FW\DP\State;


class Context
{

	// Aktuální stav
	private $state;

	function __construct()
	{
		$this->state = new HappyState();
	}

	public function express()
	{
		echo 'Tedka Ti řeknu, jak se cítím<br>';
		$this->state->express();
	}

	public function beHappy()
	{
		echo 'Tedka budu veselý<br>';

		$this->state = new HappyState();
	}

	public function beSad()
	{
		echo 'Tedka budu smutný<br>';
		$this->state = new SasState();
	}

}