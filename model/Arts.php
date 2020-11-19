<?php


namespace model;


class Arts
{
    private $id;
    private $naam;
    private $telefoon;
    private $specialisatie;

    public function getId(){
        return $this->id;
    }
    public function getNaam(){
        return $this->naam;
    }
    public function getTelefoon(){
        return $this->telefoon;
    }
    public function getSpecialisatie(){
        return $this->specialisatie;
    }

}