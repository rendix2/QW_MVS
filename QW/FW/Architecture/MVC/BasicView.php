<?php
namespace QW\FW\Architecture\MVC;

use QW\FW\Basic\Object;

final class BasicViewException extends \Exception {
}

class BasicView extends Object {
	const ADMIN_DIR_NAME = 'Admin/';
	const PATH_TO_TEMPLATES = './QW/Templates/';
	const USER_DEFAULT_NAME = 'Default/';
	const USER_DIR_NAME = 'Web/';

	protected $pathToTemplate;
	protected $tableData;
	protected $pageName;

	public function __construct() {
		parent::__construct();

		$this->pathToTemplate = self::PATH_TO_TEMPLATES . self::USER_DIR_NAME . 'Default/';
		$this->pageName = "";
	}

	public function __destruct() {
		$this->pathToTemplate = NULL;
		$this->tableData      = NULL;
		$this->pageName       = NULL;

		parent::__destruct();
	}

	final public function getPageName() {
		return $this->pageName;
	}

	final public function setPageName( $pageName ) {
		$this->pageName = $pageName;
	}

	final public function getTableData() {
		return $this->tableData;
	}

	final public function setTableData( array $table ) {
		$this->tableData = $table;
	}

	public function render( $name, $include = FALSE ) {
		try {
			if ( $include == TRUE ) if ( file_exists( $this->pathToTemplate . $name .
				'.php' ) ) include_once( $this->pathToTemplate . $name . '.php' );
			else
				throw new BasicViewException( 'Nesprávný název view' );
			else {
				if ( file_exists( $this->pathToTemplate . 'Header.php' ) ) include_once( $this->pathToTemplate .
					'Header.php' );
				else
					throw new BasicViewException( 'Neexistující Header.' );

				if ( file_exists( $this->pathToTemplate . $name . '.php' ) ) include_once( $this->pathToTemplate .
					$name . '.php' );
				else
					throw new BasicViewException( 'Nesprávný název view' );

				if ( file_exists( $this->pathToTemplate . 'Footer.php' ) ) include_once( $this->pathToTemplate .
					'Footer.php' );
				else
					throw new BasicViewException( 'Neexistující Footer.' );
			}

			return TRUE;
		}
		catch ( BasicViewException $BVE ) {
			echo $BVE->getMessage();

			return FALSE;
		}
	}
}