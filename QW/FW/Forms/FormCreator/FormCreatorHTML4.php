<?php

namespace QW\FW\Forms\FormCreator;

use QW\FW\Basic\Object;
use QW\FW\Boot\IllegalArgumentException;
use QW\FW\Boot\NullPointerException;

class FormCreatorHTML4 extends Object {
	protected $formData;
	private $method;
	private $action;
	private $select;

	public function __construct( $method = 'post', $action = '', $name = '' ) {
		$this->action     = $action;
		$this->method     = $method;
		$this->formData[] = '<form method="' . $this->method . '" action="' . $this->action . '" name="' . $name . '">';
		$this->select     = NULL;
	}

	function __toString() {
		$finalData = '';

		foreach ( $this->formData as $v ) $finalData .= $v;

		return $finalData . '</form>';
	}

	public function addButton( $name, $value = '' ) {
		$this->formData[] = '<button name="' . $name . '">' . $value . '</button>';

		return $this;
	}

	public function addInputCheckbox( $name, $value = '' ) {
		$this->formData[] = '<input type="checkbox" name="' . $name . '" value="' . $value . '">';

		return $this;
	}

	public function addInputHidden( $name, $value = '' ) {
		$this->formData[] = '<input type="hidden" name="' . $name . '" value="' . $value . '">';

		return $this;
	}

	public function addInputImage( $name, $src ) {
		if ( !file_exists( $src ) ) throw new IllegalArgumentException();

		$this->formData[] = '<input type="image" name="' . $name . '" src="' . $src . '">';

		return $this;
	}

	public function addInputPassword( $name, $size = '', $maxlength = '' ) {
		$this->formData[] = '<input type="password" name="' . $name . '" value="" maxlength="' . $maxlength . '">';

		return $this;
	}

	public function addInputRadio( $name, $value = '', $checked = '' ) {
		$checked = $checked ? 'checked="checked' : '';

		$this->formData[] = '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $checked . '>';

		return $this;
	}

	public function addInputReset( $name, $value = '' ) {
		$this->formData[] = '<input type="reset" name="' . $name . '" value="' . $value . '">';

		return $this;
	}

	public function addInputSubmit( $name, $value = '' ) {
		$this->formData[] = '<input type="submit" name="' . $name . '" value="' . $value . '">';

		return $this;
	}

	public function addInputText( $name, $value = '', $size = '', $maxlength = '', $autocomplete = 'off' ) {
		$this->formData[] =
			'<input type="text" name="' . $name . '" value="' . $value . '" size="' . $size . '" maxlength="' .
			$maxlength . '" autocomplete="' . $autocomplete . '">';

		return $this;
	}

	public function addSelect() {
		if ( $this->select == NULL ) throw new NullPointerException();

		$this->formData[] = $this->select->getFinal();
		$this->select     = NULL;

		return $this;
	}

	public function addTextArea( $name, $value = '' ) {
		$this->formData[] = '<textarea name="' . $name . '">' . $value . '</textarea>';

		return $this;
	}

	public function createSelect( $name, $multiple = FALSE, $size = 5, $disabled = FALSE ) {
		return ( $this->select == NULL ) ? new FormCreatorSelect( $this, $name, $multiple, $size, FALSE ) :
			$this->select;
	}
}