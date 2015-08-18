<?php

namespace QW\FW\Interfaces;

interface IP {
	public function getIP ();

	public function getLong ();

	public function getPart ( $part );

}