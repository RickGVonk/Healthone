<?php
namespace controller;
include_once "model/Model.php";
use model\Model;
include_once "view/View.php";
use view\View;

class Controller
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View($this->model);
    }
    public function updateModel(string $newContent){
        $this->model->content = $newContent;
    }
    public function updateView(){
        $this->view->viewContent();
    }
}