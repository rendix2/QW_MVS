<?php

namespace QW\FW\WebDesign\Captcha\EasyCaptcha;

use QW\FW\Basic\Object;
use QW\FW\Basic\String;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Utils\Hash\Hash;
use QW\FW\Utils\Math\Geom\Point;
use QW\FW\Utils\Math\Math;
use QW\FW\WebDesign\Images\Images;
use QW\FW\WebDesign\Paint\Color;


class EasyCaptcha extends Object {

	private $captcha;
	private $text;

	public function __construct( $width = 400, $height = 200, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !is_numeric( $width ) || !is_numeric( $height ) ) throw new IllegalArgumentException();

		$this->captcha = new Images( $width, $height );
		$this->captcha->setBackgroundColor( new Color( 0, 0, 0 ) );
		$this->captcha->setTextColor( new Color( 255, 255, 255 ) );
		$string     = new String( Hash::r() );
		$this->text = $string->subString( 0, Math::randomInterval( 6, 8 ) );
		$this->captcha->setText( Math::randomInterval( 2, 6 ), new Point( 0, 0 ), $string, FALSE );
	}

	public function __destruct() {
		$this->captcha = NULL;
		$this->text    = NULL;

		parent::__destruct();
	}

	public function getBMP() {
		$this->captcha->toBMP();
	}

	public function getGIF() {
		$this->captcha->toGIF();
	}

	public function getJPG() {
		$this->captcha->toJPG();
	}

	public function getPNG() {
		$this->captcha->toPNG();
	}

	public function getText() {
		return $this->text;
	}
}
