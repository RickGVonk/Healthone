<?php
namespace model;
class Drug
{
    private $id;
    private $maker;
    private $name;
    private $compensated;
    private $benefits;
    private $sideEffects;

    public function __construct($id, $maker, $name, $compensated, $benefits, $sideEffects){
     $this->id = $id;
     $this->maker = $maker;
     $this->name = $name;
     $this->compensated = $compensated;
     $this->benefits = $benefits;
     $this->sideEffects = $sideEffects;
    }
    public function getId(){
    return $this->id;
    }
    public function setId($id){
    $this->id = $id;
    }
    public function getMaker(){
    return $this->maker;
    }
    public function setMaker($maker){
    $this->maker = $maker;
    }
    public function getName(){
    return $this->name;
    }
    public function setName($name){
    $this->name = $name;
    }
    public function getCompensated(){
    return $this->compensated;
    }
    public function setCompensated($compensated){
    $this->compensated = $compensated;
    }
    public function getBenefits(){
    return $this->benefits;
    }
    public function setBenefits($benefits){
    $this->benefits = $benefits;
    }
    public function getSideEffects(){
    return $this->sideEffects;
    }
    public function setSideEffects($sideEffects){
        $this->sideEffects = $sideEffects;
    }

}