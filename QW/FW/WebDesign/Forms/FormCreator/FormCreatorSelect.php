<?php

	namespace QW\FW\WebDesign\Forms\FormCreator;

	use QW\FW\Basic\Object;
	use QW\FW\Boot\IllegalArgumentException;

	class FormCreatorSelect extends Object {
		private $formCreatorHTML4;

		private $content;
		private $objectsCounter;
		private $multiple;
		private $size;
		private $disabled;

		public function __construct ( FormCreatorHTML4 $formCreatorHTML4, $name, $multiple, $size, $disabled ) {
			parent::__construct ();

			$this->formCreatorHTML4 = $formCreatorHTML4;
			$this->content          = [ ];
			$this->objectsCounter   = $name;
			$this->multiple         = $multiple == TRUE ? 'multiple="multiple' : '';

			if ( !is_numeric ( $size ) ) throw new IllegalArgumentException();

			$this->size = $size;
		}

		public function __destruct () {
			$this->content        = NULL;
			$this->objectsCounter = NULL;
			$this->multiple       = NULL;
			$this->size           = NULL;
			$this->disabled       = NULL;

			parent::__destruct ();
		}

		public function addChoice ( $data, $selected = FALSE, array $disabled ) {
			$this->content[] = $data;

			return $this;
		}

		public function addList ( array $data, array $selected, array $disabled ) {
			$this->content[] = $data;

			return $this;
		}

		public function getContent () {
			return $this->content;
		}

		public function getFinal () {
			$final = '<select name="' . $this->objectsCounter . '" ' . $this->multiple . '>';

			foreach ( $this->content as $v ) $final .= "<option name=\"" . key ( $this->content ) . "\">{$v}</option>\n";

			return $final;
		}
	}