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
    link
    <title>Espace personnel</title>
</head>
<body>

<?php
if($_SESSION['valide'] == 0){
echo'<br>
<form action="index.php" method="post">
    <input type="submit" value="Retour à l\'accueil">
</form>
<h2>Changez votre mot de passe pour valider votre compte</h2>
<br>
<form action="validationNouveauMdp.php" method="post" onsubmit="return validationNouveauMdp()">
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
else{
    echo'<h2>Compte validé<h2><br><form action="index.php" method="post">
    <input type="submit" value="Retour à l\'accueil">
</form>';
}
?>
    


<script src="main.js"></script>
</body>
</html>



