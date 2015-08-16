<?php
/**
 * Created by PhpStorm.
 * UserController: Tom
 * Date: 20. 5. 2015
 * Time: 1:40
 */

namespace QW\FW\Interfaces;


interface ILanguage
{
	public function languageGetPack();

	public function languageGetMetaPack();

	public function languageGetAllPackages();
}