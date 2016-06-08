<?php

	namespace QW\FW\DP\Visitor;

	class ShowOfUse {

		public function __construct () {
			$goodVisit = new GoodVisitor();
			$badVisit  = new BadVisitor();

			$cinema = new Cinema();
			$museum = new Museum();

			$museum->accept ( $goodVisit );
			$cinema->accept ( $goodVisit );

			$cinema->accept ( $badVisit );
			$museum->accept ( $badVisit );
		}
	}