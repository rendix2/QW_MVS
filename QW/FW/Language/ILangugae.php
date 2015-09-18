<?php
/**
 * Created by PhpStorm.
 * UserController: Tom
 * Date: 20. 5. 2015
 * Time: 1:40
 */

namespace QW\FW\Language;


interface ILanguage {
	public function languageGetAllPackages();

	public function languageGetMetaPack();

	public function languageGetPack();
}