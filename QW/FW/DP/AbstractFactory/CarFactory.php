<?php
	/**
	 * Created by PhpStorm.
	 * User: Tom
	 * Date: 21. 6. 2015
	 * Time: 18:56
	 */

	namespace QW\FW\DP\AbstractFactory;


	class CarFactory implements VehicleFactory {

		public function createBigVehicle () {
			return new Car();
		}

		public function createSmallVehicle () {
			return new Truck();
		}
	}