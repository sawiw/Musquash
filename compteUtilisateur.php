<?php
session_start();
require('sql/bddConnexion.php');
echo'<h2>Bienvenue sur votre espace personnel Musquash '.$_SESSION['login'].'.</h2>';
?>


<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="icon" type="image/x-icon" href="ressources/icons/favicon.ico">
  <title>Musquash - Mon Compte</title>
</head>

<?php
if(array_key_exists('login', $_SESSION)){
    echo 'Connecté en tant que : ' . $_SESSION['login'] ;
    include('dossierIncludes\barreNavCo.php');
}
else{
    echo 'Non connecté
    ';
    include('dossierIncludes\barreNavNonCo.php');
}
?>

<?php
if($_SESSION['valide'] == 0){
echo'
<div class="moncompte-container">
<form action="index.php" method="post">
    <input type="submit" value="Retour à l\'accueil">
</form>
<h2>Changez votre mot de passe pour valider votre compte</h2>
    <div class=moncompte-formulaire>
        <form action="validationNouveauMdp.php" method="post" onsubmit="return validationNouveauMdp()">
        <label for="mdpProvisoire">Entrez votre mot de passe provisoire: </label>
        <input required type="password" minlength="8" maxlength="50" name="mdpProvisoire" id="mdpProvisoire">
        <label for="modifMdp1">Votre nouveau mot de passe : </label>
        <input required type="password" minlength="8" maxlength="50" name="modifMdp1" id="modifMdp1">
        <label for="">Confirmer votre mot de passe : </label>
        <input required type="password" minlength="8" maxlength="50" name="modifMdp2" id="modifMdp2">
        <input type="submit" value="Valider le nouveau mot de passe">
        </form>
    </div>
</div>';
}
else{
    echo'<form action="index.php" method="post">
    <input type="submit" value="Retour à l\'accueil">
</form>';
}
?>
    

<?php
include("dossierIncludes/footer.php");
?>
<script src="main.js"></script>
</body>
</html>



