<?php

namespace QW\FW\WebDesign\Forms\FormCreator;

class FormCreatorHTML5 extends FormCreatorHTML4 {
	public function addInputColor( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="color" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) .
			'>';

		return $this;
	}

	public function addInputDate( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="date" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) . '>';

		return $this;
	}

	public function addInputDateTime( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="datetime" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) .
			'>';

		return $this;
	}

	public function addInputDateTimeLocal( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] = '<input type="datetime-local" name="' . $name . '" value="' . $value . '" ' .
			$this->otherAttributes( $params ) . '>';

		return $this;
	}

	public function addInputEmail( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="email" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) .
			'>';

		return $this;
	}

	public function addInputMonth( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="month" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) .
			'>';

		return $this;
	}

	public function addInputNumber( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="number" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) .
			'>';

		return $this;
	}

	public function addInputRange( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="range" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) .
			'>';

		return $this;
	}

	public function addInputSearch( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="search" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) .
			'>';

		return $this;
	}

	public function addInputTel( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="tel" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) . '>';

		return $this;
	}

	public function addInputTime( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="time" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) . '>';

		return $this;
	}

	public function addInputURL( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="url" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) . '>';

		return $this;
	}

	public function addInputWeek( $name, $value = '', array  $params = [ ] ) {
		$this->formData[] =
			'<input type="week" name="' . $name . '" value="' . $value . '" ' . $this->otherAttributes( $params ) . '>';

		return $this;
	}
}