<?php
	/**
	 * Created by PhpStorm.
	 * User: Tom
	 * Date: 21. 6. 2015
	 * Time: 18:55
	 */

	namespace QW\FW\DP\AbstractFactory;


	interface VehicleFactory {

		public function createBigVehicle ();

		public function createSmallVehicle ();

	}