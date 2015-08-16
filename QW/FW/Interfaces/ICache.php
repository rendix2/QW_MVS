<?php

namespace QW\FW\Interfaces;

interface ICache {
	public function addCache($data);

	public function removeCache();

	public function useCache();
}
