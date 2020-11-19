<?php
namespace view;
include_once ('model/Model.php');
include_once('model/Patient.php');

class View
{
    private $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function showPatienten($result = null){
        if($result == 1){
            echo "<h4>Actie geslaagd</h4>";
        }
        $patienten = $this->model->getPatientenMetArts();

        /*de html template */
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Overzicht patienten</title>
                    <style>
                        #patienten{
                            display:grid;
                            grid-template-columns:repeat(4,1fr);                
                            grid-column-gap:10px;
                            grid-row-gap:10px;
                            justify-content: center;
                        }
                        .patient{
                            width:80%;
                            background-color:#ccccff;
                            color:darkslategray;
                            font-size:24px;
                            padding:10px;
                            border-radius:10px;
                        }
                    </style>
                </head>
                <body>";

        if (!isset($_SESSION['user']))
        {
            require ("templates/loginform.php");
        }
        else {
            echo "<h2>Patienten overzicht</h2> ";
            if (isset($_SESSION['user'])) {
               echo" <form action='index.php' method='post'>
                       <input type='hidden' name='logout' value='0'>
                       <input type='submit' value='Uitloggen'/>
                       </form>";

                if ($_SESSION['role'] == "admin") {
                    echo "
                    
                       
                       <form action='index.php' method='post'>
                       <input type='hidden' name='showForm' value='0'>
                       <input type='submit' value='toevoegen'/>
                       </form>
                      ";
                }
            }

            if ($patienten !== null) {
                echo "
                <div id=\"patienten\">";
                foreach ($patienten as $patient) {
                    echo "<div class=\"patient\">
                               
                              $patient->naam<br />
                              $patient->adres<br />
                              $patient->woonplaats<br />
                              $patient->zknummer<br />
                              $patient->geboortedatum<br />
                              $patient->soortverzekering<br />
                              $patient->artsnaam";



                    if ($_SESSION['role'] == "admin") {
                        echo "
                                  <form action='index.php' method='post'>
                                   <input type='hidden' name='showForm' value='$patient->id'><input type='submit' value='wijzigen'/></form>
                                    <form action='index.php' method='post'>
                                   <input type='hidden' name='delete' value='$patient->id'><input type='submit' value='verwijderen'/></form>";
                    }//end if user is set
                    echo " </div></body></html>";
                }//end for each
            }//end if patienten is set
            else {
                echo "Geen patienten gevonden";
            }
        }
    }
    public function showFormPatienten($id=null){
        if($id !=null && $id !=0){
            $patient = $this->model->selectPatient($id);
        }
        /*de html template */
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Beheer patientengegevens</title>
        </head><body>
        <h2>Formulier patientgegevens</h2>";
    if(isset($patient)){
        echo "<form method='post' >
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value='$id'/></td></tr>
             <tr><td>   <label for=\"naam\">Patient naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= '".$patient->naam."'/></td></tr>
            <tr><td>
                <label for=\"adres\">adres</label></td><td>
                <input type=\"text\" name=\"adres\" value = '".$patient->adres."'/></td></tr>
            <tr><td>
                <label for=\"woonplaats\">woonplaats</label></td><td>
                <input type=\"text\" name=\"woonplaats\" value= '".$patient->woonplaats."'/></td></tr>
            <tr><td>
                <label for=\"geboortedatum\">geboortedatum</label></td><td>
                <input type=\"text\" name=\"geboortedatum\" value= '".$patient->geboortedatum."'/></td></tr>
            <tr><td>
                <label for=\"zknummer\">zknummer</label></td><td>
                <input type=\"text\" name=\"zknummer\" value= '".$patient->zknummer."'/></td></tr>
                 <tr><td>
                <label for=\"soortverzekering\">soortverzekering</label></td><td>
                <input type=\"text\" name=\"soortverzekering\" value= '".$patient->soortverzekering."'/></td></tr>
                <tr><td>
                <label for=\"artsid\">arts</label></label></td><td>
                <input type=\"text\" name=\"artsid\" value= '".$patient->artsid ."'/></td></tr>
            <tr><td>
                <input type='submit' name='update' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
    }
    else
        {
        /*de html template */
        echo "<form method='post' action='index.php'>
        <table>
            <tr><td></td><td>
                <input type=\"hidden\" name=\"id\" value=''/></td></tr>
             <tr><td>   <label for=\"naam\">Patient naam</label></td><td>
                <input type=\"text\" name=\"naam\" value= ''/></td></tr>
            <tr><td>
                <label for=\"adres\">adres</label></td><td>
                <input type=\"text\" name=\"adres\" value = ''/></td></tr>
            <tr><td>
                <label for=\"woonplaats\">woonplaats</label></td><td>
                <input type=\"text\" name=\"woonplaats\" value= ''/></td></tr>
            <tr><td>
                <label for=\"geboortedatum\">geboortedatum</label></td><td>
                <input type=\"text\" name=\"geboortedatum\" value= ''/></td></tr>
            <tr><td>
                <label for=\"zknummer\">zknummer</label></td><td>
                <input type=\"text\" name=\"zknummer\" value= ''/></td></tr>
                 <tr><td>
                <label for=\"soortverzekering\">soortverzekering</label></td><td>
                <input type=\"text\" name=\"soortverzekering\" value= ''/></td></tr>
                  <tr><td>
                <label for=\"artsid\">arts</label></td><td>
                <input type=\"text\" name=\"artsid\" value= ''/></td></tr>
            <tr><td>
                <input type='submit' name='create' value='opslaan'></td><td>
            </td></tr></table>
            </form>
        </body>
        </html>";
        }
    }
}