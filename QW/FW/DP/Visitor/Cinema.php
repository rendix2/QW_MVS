<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 20. 6. 2015
 * Time: 15:07
 */

namespace QW\FW\DP\Visitor;


class Cinema implements Place
{

	public function accept( Visitor $visitor )
	{
		echo 'Do kina šel: ' . $visitor;

		$visitor->visitCinema( $this );
	}
}