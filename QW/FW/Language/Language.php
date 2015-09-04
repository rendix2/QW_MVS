<?php
namespace QW\Libs;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Interfaces\ILanguage;

class Language extends Object implements ILanguage {
	const EXT = '.ini';
	const PATH = './Languages/';
	const PREFIX_NAME = '/lang';
	const PREFIX_NAME_META = '/langMeta';
	private $langName;
	private $lang;
	private $meta;
	private $allPackages;

	public function __construct( $langName, $debug = FALSE ) {
		parent::__construct( $debug );

		if ( !preg_match( '#^[A-Z]*$#', $langName ) ) throw new IllegalArgumentException();

		foreach ( glob( self::PATH . '*' ) as $languages ) $this->allPackages[] = $languages;

		$this->langName = $langName;

		// we don't have any other languages yet
		if ( $this->langName != 'CZ' ) $this->langName = 'CZ';

		if ( !file_exists( self::PATH .
			$this->langName )
		) throw new LanguageException( 'Neexistující celý jazykový balíček: <strong>' . $this->langName .
			'</strong>.' );

		if ( !file_exists( self::PATH . $this->langName . self::PREFIX_NAME . $this->langName .
			self::EXT )
		) throw new LanguageException( 'Neexistující jazykový balíček: <strong>' . $langName . '</strong>.' );

		if ( !file_exists( self::PATH . $this->langName . self::PREFIX_NAME_META . $this->langName .
			self::EXT )
		) throw new LanguageException( 'Neexistující jazykový balíček meta dat: <strong>' . $langName . '</strong>.' );

		$this->lang = parse_ini_file( self::PATH . $this->langName . self::PREFIX_NAME . $this->langName . self::EXT );
		$this->meta =
			parse_ini_file( self::PATH . $this->langName . self::PREFIX_NAME_META . $this->langName . self::EXT );
	}

	public function __destruct() {
		$this->lang        = NULL;
		$this->langName    = NULL;
		$this->meta        = NULL;
		$this->allPackages = NULL;

		parent::__destruct();
	}

	public function languageGetAllPackages() {
		return $this->allPackages;
	}

	public function languageGetMetaPack() {
		return $this->meta;
	}

	public function languageGetPack() {
		return $this->lang;
	}
}