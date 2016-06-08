<?php

	namespace QW\FW\DataStructures\Cache;

	interface ICache {
		public function addCache ( $data );

		public function removeCache ();

		public function updateCache ( $data );

		public function useCache ();
	}
