<?php
namespace QW\FW\Utils\Mail;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Utils\Math\Geom\Point;
use QW\FW\Validator;
use QW\FW\WebDesign\Images\Images;
use QW\FW\WebDesign\Paint\Color;

final class Mail extends Object {

	private $to, $subject, $text;

	public function __construct( $to, $subject, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( Validator::validateEmailUsingJakubVrana( $to ) ) $this->to = $to;
		else throw new IllegalArgumentException( 'Neplatná E-mailová adresa.' );

		$this->subject = $subject;
	}

	// Jakub Vrána php.vrana.cz

	private function createImageOfTextEmail() {
		$image = new Images( 100, 50, FALSE, $this->debug );
		$image->setText( 1, new Point( 50, 25, $this->debug ), $this->to, FALSE,
			new Color( 255, 255, 255, $this->debug ) );
		$image->setBackgroundColor( new Color( 0, 0, 0, $this->debug ) );
		header( 'Content-Type: image/png' );

		return $image->toPNG();
	}

	private function deleteImageOfTextEmail() {
	}

	private function mimeHeaderEncode( $text, $encoding = "utf-8" ) {
		return "=?$encoding?Q?" . imap_8bit( $text ) . "?=";
	}

	public function sendEmail() {
		if ( empty( $this->text ) ) throw new MailException( 'Prázdný text E-mailu' );

		return mb_send_mail( $this->to, $this->subject, $this->text );
	}

	public function setText( $text ) {
		if ( empty( $text ) ) throw new IllegalArgumentException( 'Prázdný text E-mailu' );

		$this->text = $text;
	}

	public function setTextFromFile( $filePath ) {
		if ( !file_exists( $filePath ) ) throw new MailException( 'Neexistující soubor pro text E-mailu.' );

		$this->text = file_get_contents( $filePath );
	}

	public function showEmail() {
		echo 'To: <img src="imagepath.jpg"><br>';
		echo 'Subject: ' . $this->subject . '<br>';
		echo '<br><br>Text: ' . $this->text . '<br><br>';
		echo 'End of preview!';

		return TRUE;
	}
}