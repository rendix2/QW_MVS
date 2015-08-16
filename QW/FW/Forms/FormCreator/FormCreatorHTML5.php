<?php

namespace QW\FW\Forms\FormCreator;

class FormCreatorHTML4HTML5 extends FormCreatorHTML4 {
	public function addInputColor($name, $value = '') {
		$this->formData[] = '<input type="color" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputDate($name, $value = '') {
		$this->formData[] = '<input type="date" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputDateTime($name, $value = '') {
		$this->formData[] = '<input type="datetime" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputDateTimeLocal($name, $value = '') {
		$this->formData[] = '<input type="datetime-local" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputEmail($name, $value = '') {
		$this->formData[] = '<input type="email" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputMonth($name, $value = '') {
		$this->formData[] = '<input type="month" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputNumber($name, $value = '') {
		$this->formData[] = '<input type="number" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputRange($name, $value = '') {
		$this->formData[] = '<input type="range" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputSearch($name, $value = '') {
		$this->formData[] = '<input type="search" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputTel($name, $value = '') {
		$this->formData[] = '<input type="tel" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputTime($name, $value = '') {
		$this->formData[] = '<input type="time" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputURL($name, $value = '') {
		$this->formData[] = '<input type="url" name="{$name}" value="{$value}">';

		return $this;
	}

	public function addInputWeek($name, $value = '') {
		$this->formData[] = '<input type="weel" name="{$name}" value="{$value}">';

		return $this;
	}
}