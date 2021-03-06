<?php
	/**
	 * Created by PhpStorm.
	 * User: Tom
	 * Date: 21. 6. 2015
	 * Time: 18:20
	 */

	namespace QW\FW\DP\Builder;


	class Building {

		private $floor, $walls, $roof;

		public function __destruct () {
			$this->floor = NULL;
			$this->roof  = NULL;
			$this->walls = NULL;
		}

		public function __toString () {
			return $this->floor . ', ' . $this->walls . ', ' . $this->roof . '.';
		}

		public function setFloor ( $floor ) {
			$this->floor = $floor;

			return $this;
		}

		public function setRoof ( $roof ) {
			$this->roof = $roof;

			return $this;
		}

		public function setWalls ( $walls ) {
			$this->walls = $walls;

			return $this;
		}
	}