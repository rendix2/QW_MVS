<?php

namespace QW\FW\IP;

interface IP {
	public function getCoded();

	public function getIP();

	public function getPart( $part );

}