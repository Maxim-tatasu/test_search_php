<?php
require_once("../model/connect.php");

if (isset($_POST['search'])){
    $word=$_POST['search'];
    if (iconv_strlen($word)>3){
        $Search= new Search();
        $Search->serach_str($word);
        }
    }
//$Search= new Search();
//$Search->serach_str($word);

?>

