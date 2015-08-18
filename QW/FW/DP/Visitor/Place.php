<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 15:06
 */

namespace QW\FW\DP\Visitor;


interface Place {
	public function accept ( Visitor $visitor );

}