<?php

namespace QW\FW\DataWorking\Search\ArraySearch;

class LinearSearch extends AbstractArraySearch {
	public function search() {
		$result = [ ];

		foreach ( $this->data as $v ) if ( $v == $this->pattern ) $result[] = $v;

		return $result;
	}
}