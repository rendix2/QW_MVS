<?php

namespace QW\FW\IP;

use QW\FW\Basic\String;
use QW\FW\Boot\IllegalArgumentException;

final class IPv6 extends AbstractIP {
	public function __construct( $ip, $safeMode = TRUE, $debug = FALSE ) {
		parent::__construct( $ip, $safeMode, $debug );
		if ( $this->getIpCountPart() != 8 ) throw new IllegalArgumentException();
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function getNiceIp() {
		$str = new String( '', $this->debug );

		for ( $i = 0; $i < 8; $i++ ) {
			$substr = new String( $this->getPart( $i ), $this->debug );
			$substr = $substr->pad( 4, '0', STR_PAD_LEFT );

			if ( $substr->getLength() != 4 ) $str = $str->concatPostString( $substr );
			else $str = $str->concatPost( $substr->getString() )
			                ->concatPost( ':' );
		}

		return $str->subString( 0, $str->getLength() - 1 )
		           ->getString();

	}

	public function getPart( $part ) {
		if ( !is_numeric( $part ) || $part < 0 || $part > 8 ) throw new IllegalArgumentException();

		return $this->ipParted[ $part ];
	}

	public function getSecureIp() {
		$string = new String( '', $this->debug );

		for ( $i = 0; $i < 6; $i++ ) $string = $string->concatPost( (string) $this->getPart( $i ) )
		                                              ->concatPost( ':' );

		return $string = $string->concatPost( 'XXX:XXX' );
	}
}