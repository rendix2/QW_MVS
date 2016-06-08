<?php
	namespace QW\Controllers;

	use QW\FW\Architecture\MVC\AbstractBasicController;
	use QW\Libs\Config;

	final class UserController extends AbstractBasicController {

		public function __construct ( $name ) {
			parent::__construct ( $name );

			$this->getView ()
			     ->setPageName ( "Uživatel" )
			;
		}

		public function __destruct () {
			parent::__destruct ();
		}

		public function index () {
			return $this->getView ()
			            ->render ( $this->getViewName () . Config::SLASH . 'index' )
			;
		}

		public function delete () {
		}

		public function edit () {
		}

		public function login () {
			$this->getView ()
			     ->setPageName ( "Přihlášení" )
			;

			$this->getView ()
			     ->render ( $this->getViewName () . Config::SLASH . 'index' )
			;
		}

		public function logout () {
			//Session::end();
		}
	}