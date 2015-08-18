<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21. 6. 2015
 * Time: 18:57
 */

namespace QW\FW\DP\AbstractFactory;


class ShipFactory implements VehicleFactory {

	public function createBigVehicle () {
		return new Boat();
	}

	public function createSmallVehicle () {
		return new Ferry();
	}
}