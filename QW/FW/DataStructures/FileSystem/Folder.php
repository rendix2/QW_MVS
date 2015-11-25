<?php

namespace QW\FW\DataStructures\FileSystem;

use FilesystemIterator;
use QW\FW\Boot\IllegalArgumentException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

final class Folder extends File {

	public function __construct( $dirName, $create = FALSE, $debug = FALSE ) {
		//parent::__construct($debug = FALSE);
		//Object::__construct($debug);

		if ( ( !is_dir( $dirName ) || !file_exists( $dirName ) ) &&
			$create == FALSE
		) throw new IllegalArgumentException();

		else if ( !file_exists( $dirName ) && $create == TRUE ) mkdir( $dirName );

		$this->filePath = $dirName;
	}

	public function __destruct() {
		parent::__destruct();
	}

	// http://stackoverflow.com/questions/478121/php-get-directory-size
	public function content() {
		$array = [ ];

		foreach ( glob( $this->filePath . '*' ) as $v ) {
			if ( $v == '.' || $v == '..' ) continue;

			$array[] = $v;
		}

		return $array;
	}

	public function delete() {
		return rmdir( $this->filePath );
	}

	public function size() {
		$bytesTotal = 0;
		$path = realpath( $this->filePath );

		if ( $path !== FALSE ) foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $this->filePath,
			FilesystemIterator::SKIP_DOTS ) ) as $object ) $bytesTotal += $object->getSize();

		return $bytesTotal;
	}
}