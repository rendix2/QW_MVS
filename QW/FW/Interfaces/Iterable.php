<?php
	/**
	 * Created by PhpStorm.
	 * User: Tom
	 * Date: 22. 6. 2015
	 * Time: 16:57
	 */

	namespace QW\FW\Interfaces;


	interface Iterable {

		public function hasNext ();

		public function next ();
	}