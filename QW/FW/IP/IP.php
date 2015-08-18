<?php

namespace QW\FW\IP;

interface IP {
	public function getIP();

	public function getLong();

	public function getPart( $part );

}