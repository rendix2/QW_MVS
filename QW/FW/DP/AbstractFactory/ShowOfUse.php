<?php
	namespace QW\FW\DP\AbstractFactory;


	class ShowOfUse {

		public function __construct () {
			$carFactory  = new CarFactory();
			$shipFactory = new ShipFactory();

			$smallCar  = $carFactory->createSmallVehicle ();
			$bigCar    = $carFactory->createBigVehicle ();
			$smallShip = $shipFactory->createSmallVehicle ();
			$bigShip   = $shipFactory->createBigVehicle ();
		}
	}