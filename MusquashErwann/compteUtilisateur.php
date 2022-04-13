<?php
session_start();
require('./sql/bddConnexion.php');
echo'<h2>Bienvenue sur votre espace personnel Musquash '.$_SESSION['login'].'.</h2>';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <title>Espace personnel</title>
</head>
<body>

<?php
if(array_key_exists('login', $_SESSION)){
    echo 'Connecté en tant que : ' . $_SESSION['login'] ;
    include('dossierIncludes\barreNavCo.php');
    if($_SESSION['valide'] == 0){
        echo'<br>
        <form action="/index.php" method="POST">
            <input type="submit" value="Retour à l\'accueil">
        </form>
        <h2>Changez votre mot de passe pour valider votre compte</h2>
        <br>
        <form action="/validationNouveauMdp.php" method="POST" onsubmit="return validationNouveauMdp()">
        <label for="mdpProvisoire">Entrez votre mot de passe provisoire: </label>
        <input required type="password" minlength="8" maxlength="50" name="mdpProvisoire" id="mdpProvisoire"><br><br>
        <label for="modifMdp1">Votre nouveau mot de passe : </label>
        <input required type="password" minlength="8" maxlength="50" name="modifMdp1" id="modifMdp1"><br><br>
        <label for="">Confirmer votre mot de passe : </label>
        <input required type="password" minlength="8" maxlength="50" name="modifMdp2" id="modifMdp2">
        <br><br>
        <input type="submit" value="Valider le nouveau mot de passe">
        </form>';
        }
        elseif($_SESSION['prof'] == false){
            echo'<form action="/index.php" method="POST">
            <input type="submit" value="Retour à l\'accueil">
            </form><br>
            
            <form action="/adhesions.php" method="POST">
            <input type="submit" value="NOS ADHÉSIONS">
            </form>';
        }
        elseif($_SESSION['prof'] == true){
            echo'<form action="/index.php" method="POST">
            <input type="submit" value="Retour à l\'accueil">
            </form><br>
            <h1>BIENVENUE PROF</h1>
            <form action="/planning.php" method="POST">
            <input type="submit" value="PLANNING DES COURS">
            </form>';
        }

}

else{
    echo 'Non connecté
    ';
    include('dossierIncludes\barreNavNonCo.php');
}

?>
    


<script src="main.js"></script>
</body>
</html>



