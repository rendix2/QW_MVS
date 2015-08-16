<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 12:14
 */

namespace QW\FW\DP\State;


class HappyState implements StateOfMind
{


	public function express()
	{
		echo 'Jsem veselý';
	}
}