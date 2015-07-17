<?php
namespace QW\FW\Smarty;

class TemplateUser extends \Smarty
{
    private $templateName;

    public function __construct($templateName)
    {
        $this->templateName = $templateName;
    }
}