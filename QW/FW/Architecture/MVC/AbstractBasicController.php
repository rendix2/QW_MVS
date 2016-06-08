<?php
	namespace QW\FW\Architecture\MVC;

	use QW\FW\Basic\Object;

	abstract class AbstractBasicController extends Object {
		private $view;
		private $model;
		private $viewName;

		abstract public function index ();

		public function __construct ( $name ) {
			parent::__construct ();

			$c = '\\QW\\Models\\' . $name . 'Model';

			//$this->view = new SmartyView();
			$this->view     = new BasicView();
			$this->model    = new $c();
			$this->viewName = str_replace ( 'Controller', '', $this->getClassName () );
		}

		public function __destruct () {
			$this->viewName = NULL;
			$this->model    = NULL;
			$this->view     = NULL;

			parent::__destruct ();
		}

		final protected function getModel () {
			return $this->model;
		}

		final protected function getView () {
			return $this->view;
		}

		final protected function getViewName () {
			return $this->viewName;
		}
	}
