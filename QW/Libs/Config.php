<?php
namespace QW\Libs;

final class Config extends \QW\FW\Config {
	const BACKSLASH = '\\';
	const EMAIL = 'rendix2@seznam.cz';
	const SLASH = '/';
	const URL = 'http://newest.vsichni-chytry.com';
	public static $dbConfig = [ 'dbHost' => 'localhost', 'dbUser' => 'xpy', 'dbPassword' => '19723698',
	                            'dbName' => 'cvutblog' ];

	public function __construct() {
		//parent::__construct();
	}
}
