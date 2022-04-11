<?php
session_start();
// require('./sql/bddConnexion.php');
require('fonctions\fonctionPlanning.php');
//require('fonctions\testAjax.js');
$semaine = new DateTime();
$semaine = intval($semaine->format('W'));

if(array_key_exists('terrain', $_GET) && array_key_exists('semaine', $_GET)){
    echo planning($_GET['terrain'],$_GET['semaine'],2022);
}

elseif(array_key_exists('terrain', $_GET)){
    echo planning($_GET['terrain'],$semaine,2022);
}

elseif(array_key_exists('semaine', $_GET)){
    echo planning(1,$_GET['semaine'],2022);
}

else{
    echo planning(1,$semaine,2022);
    print_r($_GET);
}
// echo planning(1,19,2022);
?>
