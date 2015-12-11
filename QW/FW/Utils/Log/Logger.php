<?php
namespace QW\FW\Utils\Log;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\DataStructures\FileSystem\File;

class Logger extends Object {

	const LOG_TYPE_DATABASE = 1;
	const LOG_TYPE_FILE = 2;
	const LOG_TYPE_GLOBAL = 0;
	const PATH = './logs/';
	const PATH_DATABASE = 'database.txt';
	const PATH_FILE = 'global.txt';
	const PATH_GLOBAL = 'global.txt';
	private $path;
	private $file;

	public function __construct( $type, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->path = self::PATH;

		switch ( $type ) {
			case self::LOG_TYPE_GLOBAL: {
				$this->path .= self::PATH_GLOBAL;
				break;
			}
			case self::LOG_TYPE_DATABASE: {
				$this->path .= self::PATH_DATABASE;
				break;
			}
			case self::LOG_TYPE_FILE: {
				$this->path .= self::PATH_FILE;
				break;
			}
			default:
				throw new IllegalArgumentException();
		}

		$this->file = new File( $this->path, TRUE, $debug );
	}

	public function __destruct() {
		$this->file = NULL;
		$this->path = NULL;

		parent::__destruct();
	}

	public function getLoggedFile() {
		return $this->file;
	}

	public function getLoggedText() {
		return $this->file->getContent();
	}

	public function log( $message ) {
		$this->file->addContent( (string) $message . "\n\n" );
	}
}
