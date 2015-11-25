<?php
namespace QW\FW\Utils\Mail;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\DataStructures\FileSystem\File;
use QW\FW\Utils\Math\Geom\Point;
use QW\FW\Validator;
use QW\FW\WebDesign\Images\Images;
use QW\FW\WebDesign\Paint\Color;

final class Mail extends Object {

	private $to, $subject, $text;

	public function __construct( $to = '', $subject = '', $text = '', $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !Validator::isEmpty( $to ) ) $this->setTo( $to );
		if ( !Validator::isEmpty( $subject ) ) $this->setSubject( $subject );
		if ( !Validator::isEmpty( $text ) ) $this->setText( $text );
	}

	public function __destruct() {
		$this->to      = NULL;
		$this->subject = NULL;
		$this->text    = NULL;

		parent::__destruct();
	}

	public function __toString() {
		$string = 'To: <b>' . htmlspecialchars( $this->to ) . '</b><br>';
		$string .= 'Subject: <b>' . htmlspecialchars( $this->subject ) . '</b><br>';
		$string .= 'Text: <b>' . htmlspecialchars( $this->text ) . '</b><br>';

		return $string;
	}

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

	public function getSubject() {
		return $this->subject;
	}

	public function getText() {
		return $this->text;
	}

	// Jakub Vrána php.vrana.cz

	public function getTo() {
		return $this->to;
	}

	public function setTo( $to ) {
		if ( !Validator::validateEmailUsingJakubVrana( $to ) ) throw new IllegalArgumentException( 'Neplatná E-mailová adresa.' );

		$this->to = $to;

		return $this;
	}

	private function mimeHeaderEncode( $text, $encoding = "utf-8" ) {
		return "=?$encoding?Q?" . imap_8bit( $text ) . "?=";
	}

	public function sendEmail() {
		if ( Validator::isEmpty( $this->text ) ) throw new MailException( 'Prázdný text E-mailu' );
		if ( Validator::isEmpty( $this->subject ) ) throw new MailException( 'Prázdný předmět E-mailu' );
		if ( Validator::isEmpty( $this->to ) ) throw new MailException( 'Prázdný příjemce E-mailu' );

		return mb_send_mail( $this->to, $this->subject, $this->mimeHeaderEncode( $this->text ), );
	}

	public function setSubject( $subject ) {
		if ( !Validator::isEmpty( $subject ) ) throw new IllegalArgumentException( 'Prázdný text předmětu' );

		$this->subject = (string) $subject;

		return $this;
	}

	public function setText( $text ) {
		if ( empty( $text ) ) throw new IllegalArgumentException( 'Prázdný text E-mailu' );

		$this->text = $text;

		return $this;
	}

	public function setTextFromFile( $filePath ) {
		try {
			$file = new File( $filePath, FALSE, $this->debug );
		}
		catch ( IllegalArgumentException $e ) {
			throw new MailException( $e->getMessage() );
		}

		$this->text = $this->mimeHeaderEncode( $file->getContent() );
	}

	public function showEmail() {
		echo 'To: <img src="imagepath.jpg"><br>';
		echo 'Subject: ' . $this->subject . '<br>';
		echo '<br><br>Text: ' . $this->text . '<br><br>';
		echo 'End of preview!';

		return TRUE;
	}
}

$z = new Mail();
$z->setSubject( 'ahoj' );
$z->setTo( 'rendix2@seznam.cz' );
$z->getText( 'awdwqaw' );
$z->sendEmail();