<?php
/**
 * Created by PhpStorm.
 * User: Tomáš
 * Date: 24. 9. 2015
 * Time: 22:10
 */

namespace QW\FW\Utils\Protocols\FTP;
;

use QW\FW\Basic\Object;

class FTPConnection extends Object {

	private $connection;

	public function __construct( $host, $userName, $password, $port = 21, $ssl = FALSE, $debug = FALSE ) {
		parent::__construct( $debug );

		$this->connection = $ssl == TRUE ? ftp_connect( $host, $port ) : ftp_ssl_connect( $host, $port );

		ftp_login( $this->connection, $userName, $password );
	}

	public function __destruct() {
		ftp_close( $this->connection );
		$this->connection = NULL;
	}

	public function chdir( $dir ) {
		return ftp_chdir( $this->connection, $dir );
	}

	public function chmod( $mode, $fileName ) {
		return ftp_chmod( $this->connection, $mode, $fileName );
	}

	public function exec( $command ) {
		return ftp_exec( $this->connection, $command );
	}

	public function fileList( $dir ) {
		return ftp_nlist( $this->connection, $dir );
	}

	public function mkdir( $dir ) {
		return ftp_mkdir( $this->connection, $dir );
	}

	public function rename( $old, $new ) {
		return ftp_rename( $this->connection, $old, $new );
	}

	public function rmdir( $dir ) {
		return ftp_rmdir( $this->connection, $dir );
	}

	public function size( $file ) {
		return ftp_size( $this->connection, $file );
	}
}