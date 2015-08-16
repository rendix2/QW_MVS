<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 5. 6. 2015
 * Time: 13:19
 */

namespace QW\Libs;

use QW\FW\Basic\IllegalArgumentException;

class SmartyView extends BasicView {

	private $smarty;

	function __construct($cache) {
		parent::__construct();

		if ( !is_bool($cache) )
			throw new IllegalArgumentException();


		$this->smarty = new \Smarty();
		$this->smarty->setTemplateDir(BasicView::PATH_TO_TEMPLATES);
		$this->smarty->caching = $cache;
		$this->smarty->setCacheDir($cache);
		$this->smarty->setCompileCheck(TRUE);
	}

	final public function getSmarty() {
		return $this->smarty;
	}

	public function render($templateName, array $data) {
		try {
			$this->smarty->assign($data);
			$this->smarty->display($templateName . '.tpl');
			$this->smarty->clearAllAssign();
		}
		catch ( \SmartyException $SM ) {
			echo $SM->getMessage();
		}
	}
}