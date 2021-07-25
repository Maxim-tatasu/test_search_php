<?php

class Controller
{
    public $search;

    public function Download(){
        
        require_once("../model/connect.php");
            $Search= new Search();
            $Search->Download2();
           
    }
   
}

$Search= new Controller();
$Search->Download();

?>