<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 11:35
 */

namespace QW\FW\DP\Proxy;


interface Table
{

	public function read( $key );

	public function write( $key, $value );

}