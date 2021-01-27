<?php


namespace model;
include_once ('model/Patient.php');
include_once ('model/User.php');
include_once('model/Arts.php');

class Model
{
    private $database;

    private function makeConnection(){
        $this->database = new \PDO('mysql:host=localhost;dbname=healthone', "root", "");
    }

    public function insertPatient($naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering, $artsid){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `patienten` (`id`, `naam`, `adres`, `woonplaats`, `zknummer`, `geboortedatum`, `soortverzekering`, `artsid`) 
                VALUES (NULL, :naam, :adres, :woonplaats, :zknummer, :geboortedatum, :soortverzekering, :artsid)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":adres", $adres);
            $query->bindParam(":woonplaats",$woonplaats);
            $query->bindParam(":zknummer", $zknummer);
            $query->bindParam(":geboortedatum", $geboortedatum);
            $query->bindParam(":soortverzekering",$soortverzekering);
            $query->bindParam(":artsid",$artsid);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.


    }
    public function updatePatient($id,$naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering,$artsid){
        $this->makeConnection();

        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare (
            "UPDATE `patienten` SET `naam` = :naam, `adres`=:adres, `woonplaats` = :woonplaats,
            `zknummer`=:zknummer, `geboortedatum`=:geboortedatum, `soortverzekering`=:soortverzekering ,`artsid`=:artsid
            WHERE `patienten`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":naam", $naam);
        $query->bindParam(":adres", $adres);
        $query->bindParam(":woonplaats",$woonplaats);
        $query->bindParam(":zknummer", $zknummer);
        $query->bindParam(":geboortedatum", $geboortedatum);
        $query->bindParam(":soortverzekering",$soortverzekering);
        $query->bindParam(":artsid",$artsid);
        $result = $query->execute();
        return $result;
    }

    public function getPatienten(){

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `patienten`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS,\model\Patient::class);
            return $result;
        }
        return null;
    }
    public function getPatientenMetArts(){

        $this->makeConnection();
        $selection = $this->database->query('SELECT `patienten`.`id`,`patienten`.`naam`, `adres`,`woonplaats`,`zknummer`,`geboortedatum`,`soortverzekering`, `artsen`.`naam` as artsid
        FROM `patienten`,`artsen` WHERE `patienten`.`artsid` = `artsen`.`id`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS,\model\Patient::class);
            return $result;
        }
        return null;
    }
    public function selectPatient($id){

        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `patienten` 
            WHERE `patienten`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        if($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\Patient::class);
            $patient = $selection->fetch();
            return $patient;
        }
        return null;
    }
    public function deletePatient($id){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `patienten` 
            WHERE `patienten`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        return $result;
    }
    public function insertBezorger($naam,$phonenumber){
        $this->makeConnection();
        if($naam !='')
        {
            $query = $this->database->prepare (
                "INSERT INTO `patienten` (`id`, `naam`, `phonenumber`) 
                VALUES (NULL, :naam, :phonenumber)");
            $query->bindParam(":naam", $naam);
            $query->bindParam(":phonenumber",$phonenumber);
            $result = $query->execute();
            return $result;
        }
        return -1;
        // id hoeft niet te worden toegevoegd omdat de id in de databse op autoincrement staat.


    }
    public function updateBezorger($id,$naam,$phonenumber){
        $this->makeConnection();

        // id moet worden toegevoegd omdat de id in de databse wordt gezocht
        $query = $this->database->prepare (
            "UPDATE `bezorger` SET `naam` = :naam, `phonenumber` =: phonenumber
            WHERE `bezorger`.`id` = :id ");
        $query->bindParam(":id", $id);
        $query->bindParam(":naam", $naam);
        $query->bindParam(":adres", $phonenumber);
        $result = $query->execute();
        return $result;
    }

    public function getBezorger(){

        $this->makeConnection();
        $selection = $this->database->query('SELECT * FROM `bezorger`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS,\model\Bezorger::class);
            return $result;
        }
        return null;
    }
    public function selectBezorger($id){

        $this->makeConnection();
        $selection = $this->database->prepare(
            'SELECT * FROM `bezorger` 
            WHERE `bezorger`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        if($result){
            $selection->setFetchMode(\PDO::FETCH_CLASS, \model\Patient::class);
            $bezorger = $selection->fetch();
            return $bezorger;
        }
        return null;
    }
    public function getBezorgersMetArts(){

        $this->makeConnection();
        $selection = $this->database->query('SELECT `bezorger`.`id`,`bezorger`.`naam`,`phonenumber`FROM `bezorger`');
        if($selection){
            $result=$selection->fetchAll(\PDO::FETCH_CLASS,\model\Bezorger::class);
            return $result;
        }
        return null;
    }
    public function deleteBezorger($id){
        $this->makeConnection();
        $selection = $this->database->prepare(
            'DELETE FROM `bezorger` 
            WHERE `bezorger`.`id` =:id');
        $selection->bindParam(":id",$id);
        $result = $selection ->execute();
        return $result;
    }

    public function login($username, $password){
        $this->makeConnection();
        $encryptwachtwoord = hash('sha256', $password);
        $query = $this->database->prepare("SELECT * FROM `users` WHERE `username` = :username");
        $query->bindParam(":username", $username);
        $result = $query->execute();
        if($result){
            $query->setFetchMode(\PDO::FETCH_CLASS,User::class);
            $apotheker = $query->fetch();
//            var_dump($encryptwachtwoord ===$apotheker->getPassword());
            if($apotheker){
                if($encryptwachtwoord == $apotheker->getPassword()){
                    $_SESSION['username'] = $apotheker->getUsername();
//                    $_SESSION['naam'] = $apotheker->getUserName();
                }
            }
        }
    }
    public function logout(){
        session_unset();
        session_destroy();
    }
}