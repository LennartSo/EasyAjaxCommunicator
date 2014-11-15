<?php
/*
 * EasyAjaxCommunicator
 *
 * @author Lennart Sommerfeld
 * @copyright (c) Lennart Sommerfeld
 * @link http://lennart-sommerfeld.de
 * @version 1.0
 */

class EasyAjaxCom {

    private $responseVarArray = null;

    function __construct(){
        // �berpr�fe ob ein JOSON String geschickt wurde
        $this->JsonArray = $this->getDataFromResponse();
    }

    private function getDataFromResponse(){
        if(isset($_GET['EasyAjaxJSONString'])){

            return json_decode($_GET['EasyAjaxJSONString'], true);
        }

        if(isset($_POST['EasyAjaxJSONString'])){
            return json_decode($_POST['EasyAjaxJSONString'], true);
        }

        return false;
    }

    // Funktionsname regestrieren
    function regFunction ($functionName) {
        $this->checkAjaxResponse($functionName);
    }

    // Wenn eine Funktion gefunden wurde ausf�hren
    function executeFunction ($functionName, $ArgsArray) {

        echo call_user_func_array ($functionName, $ArgsArray);
        die(0);
    }

    // �berpr�fe ob der �bergebene Name der Funktionen �bereinstimmt
    function checkAjaxResponse($tempfunctionName){
        if (array_key_exists($tempfunctionName, $this->JsonArray) == true) {
            $this->executeFunction($tempfunctionName,$this->JsonArray[$tempfunctionName]);
            return true;
        }
        return false;
    }

    function sendArray($data){
        if(is_array($data) == true){
            echo json_encode($data);
        }
    }

    function sendHTML($data){
        if(is_string($data)){
            echo $data;
        }
    }
} 