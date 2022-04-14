<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/reset.css">
  <title>Musquash</title>
</head>

<body>
<?php 
    
    if(array_key_exists('admin', $_SESSION)){
      
      if($_SESSION['admin'] == true && $_SESSION['prof'] == false){
        echo 'Connecté en tant que : ' . $_SESSION['login'] ;
        include('backOffice/backOfficeAdmin.php');
      }
    }
    if(array_key_exists('prof', $_SESSION)){
      
      if($_SESSION['prof'] == true && $_SESSION['admin'] == false){
        echo 'Connecté en tant que : ' . $_SESSION['login'] ;
        include('backOffice/backOfficeProf.php');
      }
    }
    
    
    if(array_key_exists('login', $_SESSION) && $_SESSION['prof'] == false && $_SESSION['admin'] == false){
      echo 'Connecté en tant que : ' . $_SESSION['login'] ;
      include('dossierIncludes\indexCo.php');
    }

    else{
        echo 'Non connecté
        ';
        include('dossierIncludes\indexNonCo.php');
    }
    
    // var_dump($_SESSION);
    //print_r($_SESSION);
?>



