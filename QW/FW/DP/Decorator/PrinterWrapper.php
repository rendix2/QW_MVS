<?php
namespace QW\FW\DP\Decorator;

use QW\FW\Basic\StringW;
use QW\FW\Boot\NullPointerException;

class PrinterWrapper {

	private $printer;
	private $charPerLine;
	private $charPerCurrentLine;

	public function __construct() {
		$this->charPerCurrentLine = 0;
		$this->charPerLine        = 100;
	}

	public function isCurrentLineFull() {
		return $this->charPerCurrentLine >= $this->charPerLine;
	}

	public function myPrint( StringW $s ) {
		if ( $s == NULL ) {
			throw new NullPointerException();
		}

		$index = 0;

		while ( $index < $s->getLength() ) {
			if ( $this->isCurrentLineFull() ) {
				$this->wrap2NewLine();
			}

			$this->printer->printChar( $s->charAt( $index ) );
			$this->charPerCurrentLine++;
			$index++;
		}
	}

	public function stringPrinter( Printer $printer ) {
		if ( $printer == NULL ) {
			throw new NullPointerException();
		}

		$this->printer = $printer;
	}

	// we cant have function print ? :O says ide

	public function wrap2NewLine() {
		if ( !( $this->printer instanceof Printer ) ) {
			throw new NullPointerException();
		}

		$this->printer->nextLine();
		$this->charPerCurrentLine = 0;
	}
}