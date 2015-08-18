<?php

namespace QW\FW\Cache;

interface ICache {
	public function addCache( $data );

	public function removeCache();

	public function useCache();
}
