<?php
	namespace QW\FW\WebDesign\Smarty;

	class TemplateUser extends \Smarty {
		private $templateName;

		public function __construct ( $templateName ) {
			parent::__construct ();

			$this->templateName = $templateName;
		}
	}