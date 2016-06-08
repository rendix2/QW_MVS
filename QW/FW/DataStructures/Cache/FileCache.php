<?php

	namespace QW\FW\DataStructures\Cache;


	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\DataStructures\FileSystem\File;

	final class FileCache extends AbstractCache implements ICache {
		const PATH = './cache/';
		private $file;

		public function __construct ( $fileName ) {
			parent::__construct ();

			if ( !preg_match ( '#^[a-zA-Z0-9-]#$', $fileName ) ) throw new IllegalArgumentException();

			$this->file = new File( self::PATH . $fileName );
		}

		public function __destruct () {
			$this->file = NULL;

			parent::__destruct ();
		}

		public function addCache ( $data ) {
			return $this->file->setContent ( self::PATH . $this->file->path (), serialize ( $data ), FILE_APPEND );
		}

		public function removeCache () {
			return $this->file->delete ();
		}

		public function useCache () {
			return unserialize ( $this->file->getContent () );
		}
	}