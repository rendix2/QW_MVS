<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 4. 10. 2015
 * Time: 17:53
 */

namespace QW\FW\Utils\Math\Geom;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;

class Square extends Object {

	private $pointLeftUp, $pointRightUp, $pointLeftDown, $pointRightDown;
	private $length;

	public function __construct( Point $pointLefUp, $length, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_numeric( $length ) ) throw new IllegalArgumentException();

		$this->pointLeftUp    = $pointLefUp;
		$this->pointLeftDown  = new Point( $this->pointLeftUp->getX(), $this->pointLeftUp->getY() - $length );
		$this->pointRightDown = new Point( $this->pointLeftUp->getX() + $length, $this->pointLeftUp->getY() - $length );
		$this->pointRightUp   = new Point( $this->pointLeftUp->getX(), $this->pointLeftUp->getY() + $length );
		$this->length         = $length;
	}

	public function factorySetLeftUpPoint( Point $pointLeftUp ) {
		return new Square( $pointLeftUp, $this->length );
	}

	public function factorySetLength( $length ) {
		return new Square( $this->pointLeftUp, $length, $this->debug );
	}

	/**
	 * @return Point
	 */
	public function getPointLeftDown() {
		return $this->pointLeftDown;
	}

	/**
	 * @return Point
	 */
	public function getPointLeftUp() {
		return $this->pointLeftUp;
	}

	/**
	 * @return Point
	 */
	public function getPointRightDown() {
		return $this->pointRightDown;
	}

	/**
	 * @return Point
	 */
	public function getPointRightUp() {
		return $this->pointRightUp;
	}

	public function getPoints() {
		return [ 'leftUp'    => $this->pointLeftUp, 'leftDown' => $this->pointLeftDown,
		         'rightUp'   => $this->pointRightUp, 'rightDown' => $this->pointRightDown ];
	}
}