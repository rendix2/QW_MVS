<?php

namespace QW\FW\Utils\IP;

interface IP {
	public function getCoded();

	public function getIP();

	public function getNiceIp();

	public function getPart( $part );

	public function getSecureIp();

}