<?php
session_start();
// require('./sql/bddConnexion.php');
require('fonctions\fonctionPlanning.php');
//require('fonctions\testAjax.js');
echo `<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/reset.css">
<link rel="icon" type="image/x-icon" href="ressources/icons/favicon.ico">
<title>Musquash - Planning Réservation</title>
</head>`;
if(array_key_exists('login', $_SESSION)){
    echo 'Connecté en tant que : ' . $_SESSION['login'] ;
    include('dossierIncludes\barreNavCo.php');
}
else{
    echo 'Non connecté
    ';
    include('dossierIncludes\barreNavNonCo.php');
}
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
