<?php
namespace controller;
include_once "view/View.php";
use view\View;
include_once "model/Patient.php";
use model\Model;

class Controller
{
    private $view;
    private $model;
    public function __construct(){
        $this->model = new Model();
        $this->view = new View($this->model);
    }
    public function checkAction()
    {
        session_start();
        /* formulier met gegevens tonen om een rij bij te werken */
        if (isset($_POST['showForm']) && $_SESSION['username']=="admin") {
            $this->showFormPatientAction($_POST['showForm']);
        }
        /* UPDATE: formulier afhandeling om een rij bij te werken */
        else if (isset($_POST['update']) && $_SESSION['username']=="admin") {
            $this->updatePatientAction();
        }
        /*login met rollen*/
        else if (isset($_POST['login'])) {
            $this->loginAction();
        }
        /*logout met rollen*/
        else if (isset($_POST['logout']) && isset($_SESSION['username'])) {

            $this->logoutAction();

        }
        /* CREATE:  formulier afhandeling nieuwe rij */
        else if (isset($_POST['create']) && $_SESSION['role']=="admin") {
            $this->createPatientAction();
            $this->createBezorgerAction();
        }
        /* DELETE:  verwijderen rijen */
        else if (isset($_POST['delete']) && $_SESSION['role']=="admin") {
            $this->deletePatientAction($_POST['delete']);
            $this->deleteBezorgerAction($_POST['delete']);
        }
        /*READ:  overzicht alle bezorger , als er niet is ingelogd dan inlogformulier*/
        else {
            $this->readPatientenAction();
            $this->readBezorgerAction();
        }
    }
    public function readPatientenAction(){
        $this->view->showPatienten();
    }

    public function showFormPatientAction($id=null){
       $this->view->showFormPatienten($id);
    }
    public function createPatientAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $adres = filter_input(INPUT_POST,'adres');
        $woonplaats = filter_input(INPUT_POST,'woonplaats');
        $geboortedatum = filter_input(INPUT_POST,'geboortedatum');
        $soortverzekering = filter_input(INPUT_POST,'soortverzekering');
        $zknummer = filter_input(INPUT_POST,'zknummer');
        $artsid = filter_input(INPUT_POST,'artsid');
        $result = $this->model->insertPatient($naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering,$artsid);
        $this->view->showPatienten($result);
    }
    public function updatePatientAction(){
        $id = filter_input(INPUT_POST,'id');
        $naam = filter_input(INPUT_POST,'naam');
        $adres = filter_input(INPUT_POST,'adres');
        $woonplaats = filter_input(INPUT_POST,'woonplaats');
        $geboortedatum = filter_input(INPUT_POST,'geboortedatum');
        $zknummer = filter_input(INPUT_POST,'zknummer');
        $soortverzekering = filter_input(INPUT_POST,'soortverzekering');
        $artsid = filter_input(INPUT_POST,'artsid');
        $result=$this->model->updatePatient($id,$naam,$adres,$woonplaats,$geboortedatum,$zknummer,$soortverzekering,$artsid);
        $this->view->showPatienten($result);
    }
    public function deletePatientAction($id){
        $result = $this->model->deletePatient($id);
        $this->view->showPatienten($result);
    }

    public function readBezorgerAction(){
        $this->view->showBezorger();
    }

    public function showFormBezorgerAction($id=null){
        $this->view->showFormBezorger($id);
    }
    public function createBezorgerAction(){
        $naam = filter_input(INPUT_POST,'naam');
        $phonenumber = filter_input(INPUT_POST,'phonenumber');
        $result = $this->model->insertBezorger($naam,$phonenumber);
        $this->view->showBezorger($result);
    }
    public function updateBezorgerAction(){
        $id = filter_input(INPUT_POST,'id');
        $naam = filter_input(INPUT_POST,'naam');
        $phonenumber = filter_input(INPUT_POST,'phonenumber');
        $result=$this->model->updatePatient($id,$naam,$phonenumber);
        $this->view->showPatienten($result);
    }
    public function deleteBezorgerAction($id){
    $result = $this->model->deleteBezorger($id);
    $this->view->showBezorger($result);
    }
    public function loginAction(){

        $username = filter_input(INPUT_POST,'username');
        $password = filter_input(INPUT_POST,'password');
        $this->model->login($username, $password);
        $this->view->showPatienten();
    }
    public function logoutAction(){
        session_unset();
        session_destroy();
    }

}
