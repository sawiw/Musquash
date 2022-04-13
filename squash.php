<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/squash.css">
    <link rel="icon" type="image/x-icon" href="ressources/icons/favicon.ico">
    <title>Musquash - Squash</title>
</head>
<body>
<?php
    if(array_key_exists('login', $_SESSION)){
        echo 'Connecté en tant que : ' . $_SESSION['login'] ;
        include('dossierIncludes\barreNavCo.php');
        include('dossierIncludes\squash_co.php');
    }
    else{
        echo 'Non connecté
        ';
        include('dossierIncludes\barreNavNonCo.php');
        include('dossierIncludes\squash_deco.php');
    }
    //print_r($_SESSION);
?>

<?php
include('dossierIncludes\services.php')?>
</div>

<?php
include('dossierIncludes\footer.php')
?>    
</body>

</html>