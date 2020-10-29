<?php
class View
{
    private $model;
    private $content;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function viewContent(){
        $this->content = $this->model->getContent();
    }
}