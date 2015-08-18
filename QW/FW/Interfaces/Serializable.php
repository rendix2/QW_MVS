<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 4. 6. 2015
 * Time: 1:07
 */

namespace QW\FW\Interfaces;


interface Serializable {

	public function serialize( $input );

	public function unserialize( $input );
}