<?php

namespace QW\FW\WebDesign\Forms;

use QW\FW\Basic\Object;
use QW\FW\Utils\SuperGlobals\Post;
use QW\FW\WebDesign\Forms\FormCreator\FormCreatorHTML4;

class Form extends Object {

	private $safeForm;
	private $form;

	public function __construct( $debug = FALSE ) {
		parent::__construct( $debug );
		$this->safeForm = new SafeForm();
		$this->form = new FormCreatorHTML4( $debug );
	}

	public function __destruct() {
		$this->safeForm = NULL;
		parent::__destruct();
	}

	public function getSafeForm() {
		return $this->safeForm;
	}

	public function isSubmit() {
		return isset( Post::get( $this->form->getSubmitName() ) );
	}
}