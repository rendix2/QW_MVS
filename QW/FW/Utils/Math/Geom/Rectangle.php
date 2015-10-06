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

class Rectangle extends Object {

	private $pointLeftUp, $pointRightUp, $pointLeftDown, $pointRightDown;
	private $lengthDown, $lengthRight;

	public function __construct( Point $pointLeftUp, $lengthDown, $lengthRight, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_numeric( $lengthDown ) || !is_numeric( $lengthRight ) ) throw new IllegalArgumentException();

		$this->pointLeftUp    = $pointLeftUp;
		$this->pointRightUp   = new Point( $this->pointLeftUp->getX() + $lengthRight, $this->pointLeftUp->getY() );
		$this->pointRightDown =
			new Point( $this->pointLeftUp->getX() + $lengthRight, $this->pointLeftUp->getY() - $lengthDown );
		$this->pointLeftDown  = new Point( $this->pointLeftUp->getX(), $this->pointLeftUp->getY() - $lengthDown );
		$this->lengthDown     = $lengthDown;
		$this->lengthRight    = $lengthRight;
	}

	public function factorySetLengthDown( $lengthDown ) {
		if ( !is_numeric( $lengthDown ) ) throw new IllegalArgumentException();

		return new Rectangle( $this->pointLeftUp, $lengthDown, $this->lengthRightt, $this->debug );
	}

	public function factorySetLengthRight( $lengthRight ) {
		if ( !is_numeric( $lengthRight ) ) throw new IllegalArgumentException();

		return new Rectangle( $this->pointLeftUp, $this->lengthDown, $lengthRight, $this->debug );
	}

	/**
	 * @return mixed
	 */
	public function getPointLeftDown() {
		return $this->pointLeftDown;
	}

	/**
	 * @return mixed
	 */
	public function getPointLeftUp() {
		return $this->pointLeftUp;
	}

	/**
	 * @return mixed
	 */
	public function getPointRightDown() {
		return $this->pointRightDown;
	}

	/**
	 * @return mixed
	 */
	public function getPointRightUp() {
		return $this->pointRightUp;
	}
}