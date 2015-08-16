<?php

namespace QW\FW\Lists;

interface IList {

	public function __toString();

	public function add($data);

	public function contains($data);

	public function get($index);

	public function getFirst();

	public function getLast();

	public function remove($index);

}