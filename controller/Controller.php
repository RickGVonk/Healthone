<?php
namespace mvc;

class Controller
{
    private $model;
    private $view;

    public function __construct(Model $model, View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }
    public function updateModel(string $newContent){
        $this->model->content = $newContent;
    }
    public function updateView(){
        $this->view->viewContent();
    }
}