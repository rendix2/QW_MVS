<?php
namespace QW\FW\Architecture\MVC;

use QW\FW\Basic\Object;

final class ControllerException extends \Exception
{
}

abstract class AbstractBasicController extends Object
{
    private $view;
    private $model;
    private $viewName;

    public function __construct($name)
    {
        parent::__construct();

        $c = '\\QW\\Models\\' . $name;

        //$this->view = new SmartyView();
        $this->view = new BasicView();
        $this->model = new $c();
        $this->viewName = str_replace('Controller', '', $this->getClassName());
    }

    abstract public function index();

    final protected function getView()
    {
        return $this->view;
    }

    final protected function getModel()
    {
        return $this->model;
    }

    final protected function getViewName()
    {
        return $this->viewName;
    }
}