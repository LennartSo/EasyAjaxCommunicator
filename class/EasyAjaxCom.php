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
    private $activ = false;

    function __construct(){
        // Überprüfe ob ein JOSON String geschickt wurde
        $this->responseVarArray = $this->getDataFromResponse();
    }

    private function getDataFromResponse(){
        if(isset($_GET['EasyAjaxJSONString'])){
            $this->activ = true;
            return json_decode($_GET['EasyAjaxJSONString'], true);
        }

        if(isset($_POST['EasyAjaxJSONString'])){
            $this->activ = true;
            return json_decode($_POST['EasyAjaxJSONString'], true);
        }

        return false;
    }

    // Funktionsname regestrieren
    function regFunction ($functionName) {
        if($this->activ == true) {
            $this->checkAjaxResponse($functionName);
        }
    }

    // Wenn eine Funktion gefunden wurde ausführen
    function executeFunction ($functionName, $ArgsArray) {

        echo call_user_func_array ($functionName, $ArgsArray);
        die(0);
    }

    // Überprüfe ob der übergebene Name der Funktionen übereinstimmt
    function checkAjaxResponse($tempfunctionName){
        if (array_key_exists($tempfunctionName, $this->responseVarArray) == true) {
            $this->executeFunction($tempfunctionName,$this->responseVarArray[$tempfunctionName]);
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