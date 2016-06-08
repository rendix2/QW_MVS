<?php

	namespace QW\FW\DP\Visitor;

	interface Visitor {

		public function __toString ();

		public function visitCinema ( Cinema $cinema );

		public function visitMuseum ( Museum $museum );
	}