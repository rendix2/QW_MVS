<?php

	namespace QW\FW\WebDesign\Language;

	interface ILanguage {
		public function languageGetAllPackages ();

		public function languageGetMetaPack ();

		public function languageGetPack ();
	}