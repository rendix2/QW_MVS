<?php

	namespace QW\FW\DataStructures\FileSystem;

	use QW\FW\Basic\Object;
	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Validator;

	class File extends Object {
		protected $filePath;

		public function __construct ( $filePath, $create = FALSE ) {
			parent::__construct ();

			if ( !Validator::isFile ( $filePath ) ) throw new IllegalArgumentException();
			if ( !self::fileExists ( $filePath ) ) {
				if ( $create == TRUE ) self::touch ( $filePath );
				else throw new IllegalArgumentException();
			}

			$this->filePath = $filePath;
		}

		public function __destruct () {
			$this->filePath = NULL;

			parent::__destruct ();
		}

		public static function fileExists ( $filePath ) {
			return file_exists ( $filePath );
		}

		public static function isReadable ( $filePath ) {
			if ( !Validator::isFile ( $filePath ) ) throw new IllegalArgumentException();

			return is_readable ( $filePath );
		}

		public static function isWritable ( $filePath ) {
			if ( !Validator::isFile ( $filePath ) ) throw new IllegalArgumentException();

			return is_writable ( $filePath );
		}

		public static function touch ( $filePath ) {
			return touch ( $filePath );
		}

		final public function accessTime () {
			return fileatime ( $this->filePath );
		}

		final public function addContent ( $content ) {
			return file_put_contents ( $this->filePath, $content, FILE_APPEND );
		}

		final public function chmod ( $mod ) {
			return chmod ( $this->filePath, $mod );
		}

		final public function createTime () {
			return filectime ( $this->filePath );
		}

		public function delete () {
			return unlink ( $this->filePath );
		}

		final public function getContent () {
			return file_get_contents ( $this->filePath );
		}

		final public function getPath () {
			return $this->filePath;
		}

		final public function group () {
			return filegroup ( $this->filePath );
		}

		final public function inode () {
			return fileinode ( $this->filePath );
		}

		final public function modificationTime () {
			return filemtime ( $this->filePath );
		}

		final public function moveUploaded ( $to ) {
			if ( !Validator::isDir ( $to ) ) throw new IllegalArgumentException();

			return move_uploaded_file ( $this->filePath, $to );
		}

		final public function owner () {
			return fileowner ( $this->filePath );
		}

		final public function parseIni () {
			return parse_ini_file ( $this->filePath );
		}

		public function permitions () {
			return fileperms ( $this->filePath );
		}

		final public function readable () {
			return self::isReadable ( $this->filePath );
		}

		final public function setContent ( $content ) {
			return file_put_contents ( $this->filePath, $content );
		}

		public function size () {
			return filesize ( $this->filePath );
		}

		final public function type () {
			return filetype ( $this->filePath );
		}

		final public function writable () {
			return self::isWritable ( $this->filePath );
		}
	}