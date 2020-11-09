<?php
namespace view;
include_once "model/Model.php";
use model\Model;
class View
{
    private $model;
    private $content;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function viewContent(){
        include "health.php";

    }
}