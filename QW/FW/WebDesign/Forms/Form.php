<?php

	namespace QW\FW\WebDesign\Forms;

	use QW\FW\Basic\Object;
	use QW\FW\Utils\SuperGlobals\Post;
	use QW\FW\WebDesign\Forms\FormCreator\FormCreatorHTML5;

	class Form extends Object {

		private $safeForm;
		private $form;

		public function __construct () {
			parent::__construct ();
			$this->safeForm = new SafeForm();
			$this->form     = new FormCreatorHTML5();
		}

		public function __destruct () {
			$this->safeForm = NULL;
			$this->form     = NULL;

			parent::__destruct ();
		}

		public function __toString () {
			return $this->form->__toString ();
		}

		final public function getForm () {
			return $this->form;
		}

		final public function getSafeForm () {
			return $this->safeForm;
		}

		final public function isSubmit () {
			return isset( Post::get ( $this->form->getSubmitName () ) );
		}
	}