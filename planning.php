<?php
session_start();
// require('./sql/bddConnexion.php');
require('fonctions\fonctionPlanning.php');
//require('fonctions\testAjax.js');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/planning.css">
    <link rel="icon" type="image/x-icon" href="ressources/icons/favicon.ico">
    <title>Musquash - Squash</title>
</head>
<?php
if(array_key_exists('login', $_SESSION) && array_key_exists('prof', $_SESSION) && $_SESSION['prof'] == false){
    echo 'Connecté en tant que : ' . $_SESSION['login'] ;
    include('dossierIncludes\barreNavCo.php');
}
elseif(array_key_exists('prof', $_SESSION) && $_SESSION['prof'] == true){
    echo'<form action="index.php" method="POST">
            <input type="submit" value="Retour à l\'accueil">
        </form>';
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
}
include 'dossierIncludes/footer.php';
?>
