<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 15:15
 */

namespace QW\FW\DP\Visitor;


class ShowOfUse {

	public function __construct() {
		$goodVisit = new GoodVisitor();
		$badVisit  = new BadVisitor();

		$cinema = new Cinema();
		$museum = new Museum();

		$museum->accept( $goodVisit );
		$cinema->accept( $goodVisit );

		$cinema->accept( $badVisit );
		$museum->accept( $badVisit );
	}
}