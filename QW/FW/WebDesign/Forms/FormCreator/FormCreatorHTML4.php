<?php

	namespace QW\FW\WebDesign\Forms\FormCreator;

	use QW\FW\Basic\Object;
	use QW\FW\Boot\IllegalArgumentException;
	use QW\FW\Boot\NullPointerException;
	use QW\FW\Utils\Hash\Hash;

	class FormCreatorHTML4 extends Object {
		protected $formData;
		protected $csfrCheckName;
		protected $csfrCheckValue;
		private   $method;
		private   $action;
		private   $select;
		private   $submitName;

		public function __construct ( $method = 'post', $action = '', $name = '' ) {
			parent::__construct ();

			$this->csfrCheckName  = Hash::r ();
			$this->csfrCheckValue = Hash::r3 ();
			$this->action         = $action;
			$this->method         = $method;
			$this->formData[]     =
			'<form method="' . $this->method . '" action="' . $this->action . '" name="' . $name . '">';
			$this->formData[]     =
			'<input type="hidden" name="' . $this->csfrCheckName . '" value="' . $this->csfrCheckValue . '">';
			$this->select         = NULL;
		}

		public function __destruct () {
			$this->formData = NULL;
			$this->method   = NULL;
			$this->action   = NULL;
			$this->select   = NULL;

			parent::__destruct ();
		}

		public function __toString () {
			if ( !$this->submitName ) throw  new IllegalArgumentException();

			$finalData = '';

			foreach ( $this->formData as $v ) $finalData .= $v;

			return $finalData . '</form>';
		}

		public function addButton ( $name, $value = '', array  $params = [ ] ) {
			$this->formData[] =
			'<button name="' . $name . '" ' . $this->otherAttributes ( $params ) . '>' . $value . '</button>';

			return $this;
		}

		public function addInputCheckbox ( $name, $value = '', array  $params = [ ] ) {
			$this->formData[] =
			'<input type="checkbox" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes ( $params ) .
			'>';

			return $this;
		}

		public function addInputHidden ( $name, $value = '', array  $params = [ ] ) {
			$this->formData[] =
			'<input type="hidden" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes ( $params ) .
			'>';

			return $this;
		}

		public function addInputImage ( $name, $src, $alt, array  $params = [ ] ) {
			if ( !file_exists ( $src ) ) throw new IllegalArgumentException();

			$this->formData[] =
			'<input type="image" name="' . $name . '" src="' . $src . '" alt="' . $alt . '" title="' . $alt . '" ' .
			$this->otherAttributes ( $params ) . '>';

			return $this;
		}

		public function addInputPassword ( $name, $maxlength = '', array  $params = [ ] ) {
			$this->formData[] = '<input type="password" name="' . $name . '" value="" maxlength="' . $maxlength . '" ' .
			$this->otherAttributes ( $params ) . '>';

			return $this;
		}

		public function addInputRadio ( $name, $value = '', $checked = '', array  $params = [ ] ) {
			$checked = $checked ? 'checked="checked' : '';

			$this->formData[] = '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $checked . ' ' .
			$this->otherAttributes ( $params ) . '>';

			return $this;
		}

		public function addInputReset ( $name, $value = '', array  $params = [ ] ) {
			$this->formData[] =
			'<input type="reset" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes ( $params ) .
			'>';

			return $this;
		}

		public function addInputSubmit ( $name, $value = '', array  $params = [ ] ) {
			$this->submitName = $name;
			$this->formData[] =
			'<input type="submit" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes ( $params ) .
			'>';

			return $this;
		}

		public function addInputText ( $name, $value = '', $size = '', $maxlength = '', $autocomplete = 'off', array  $params = [ ] ) {
			$this->formData[] =
			'<input type="text" name="' . $name . '" value="' . $value . '" size="' . $size . '" maxlength="' .
			$maxlength . '" autocomplete="' . $autocomplete . '" ' . $this->otherAttributes ( $params ) . '>';

			return $this;
		}

		public function addSelect () {
			if ( $this->select == NULL ) throw new NullPointerException();

			$this->formData[] = $this->select->getFinal ();
			$this->select     = NULL;

			return $this;
		}

		public function addTextArea ( $name, $value = '', array  $params = [ ] ) {
			$this->formData[] =
			'<textarea name="' . $name . '" ' . $this->otherAttributes ( $params ) . '>' . $value . '</textarea>';

			return $this;
		}

		public function createSelect ( $name, $multiple = FALSE, $size = 5, $disabled = FALSE ) {
			return ( $this->select == NULL ) ? new FormCreatorSelect( $this, $name, $multiple, $size, $disabled,
			FALSE ) :
			$this->select;
		}

		final public function getCsfrCheckName () {
			return $this->csfrCheckName;
		}

		final public function getCsfrCheckValue () {
			return $this->csfrCheckValue;
		}

		public function getSubmitName () {
			return $this->submitName;
		}

		protected function otherAttributes ( array $array ) {
			$res = '';

			foreach ( $array as $k => $v ) {
				$res .= " " . $k . '="' . $v . '" ';
			}

			return $res;
		}
	}