<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21. 6. 2015
 * Time: 18:31
 */

namespace QW\FW\DP\Builder;


class Director
{

	public function build( Builder $builder )
	{
		return $builder->buildWalls()->buildRoof()->buildFloor()->getResult();
	}
}