<?php
namespace mvc;

class Model
{
    public $content;

    public function __construct(){
        $this->content = "Hello world!";
    }
    public function getContent(){
        return $this->content;
    }
    public function setContent(string $content){
        $this->content = $content;
    }
}