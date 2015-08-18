<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 19. 6. 2015
 * Time: 20:08
 */

namespace QW\FW\DP\Adapter;


class ShowUseAdapter {

	function __construct () {
		$adapter = new Adapter();
		$adapter->newRequest();
	}
}