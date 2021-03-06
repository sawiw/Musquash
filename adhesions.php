<?php
session_start();

require_once('./sql/bddConnexion.php');
require_once('fonctions\calculPrixAdhesion.php');

if(array_key_exists('login', $_SESSION)){
    echo 'Connecté en tant que : ' . $_SESSION['login'] ;
}
else{
    echo 'Non connecté';
}

echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="icon" type="image/x-icon" href="ressources/icons/favicon.ico">
    <title>Musquash - Adhesions</title>
</head>';
echo '<body>';

if(array_key_exists('login', $_SESSION)){
    echo 'Connecté en tant que : ' . $_SESSION['login'] ;
    include('dossierIncludes\barreNavCo.php');
    echo '
<form action="index.php" method="post"style="display: flex;
justify-content: center;">
<input class="btn-item-bleu" type="submit" value="Retour à l\'accueil">
</form>
<div class="formulaire-adhesions">
    <form action="/verifications/traitementAdhesion" method="GET">
    <div class="item-formulaire-adhesions">
        <label for="squashColl">Adhésion cours de squash collectif</label>
        <input type="radio" name="adhesion" value="1" id="squashColl" required>
    </div>

    <div class="item-formulaire-adhesions">
        <label for="squashInd">Adhésion cours de squash individuel</label>
        <input type="radio" name="adhesion" value="2" id="squashInd">
    </div>
    <div class="item-formulaire-adhesions">
        <label for="squashTerrain">Adhésion location de terrain de squash</label>
        <input type="radio" name="adhesion" value="3" id="squashTerrain">
    </div>
    <div class="item-formulaire-adhesions">
        <label for="gym">Adhésion cours de gym</label>
        <input type="radio" name="adhesion" value="4" id="gym">
    </div>
    <div class="item-formulaire-adhesions">
        <label for="squashColl">Adhésion musculation</label>
        <input type="radio" name="adhesion" value="5" id="muscu">
    </div>
    <span>&nbsp;</span>
    <div class="item-formulaire-adhesions">
        <label for="duree">Durée de souscription : </label>
        <select required name="duree" id="duree">
            <option value="1">Mois</option>
            <option value="3">Trimestre</option>
            <option value="6">Semestre</option>
            <option value="12">Année</option>
    </select>
    </div>
    <br><br>
    <input class="btn-blanc-orange" type="submit" name"validationForm" value="Souscrire">
    </form>
</div>
';
}
else{
    include('dossierIncludes\barreNavNonCo.php');
    echo "<div class='adhesions-pas-co'>
    <h1>Veuillez vous connecter afin d'adhérer à une formule</h1>
    </div>
    ";
}
//print_r($_SESSION);


include('dossierIncludes\footer.php');
echo'</body>
</html>';

if(isset($_GET['validationForm'])){
    $reponse='';
    //CHECK SI L'UTILISATEUR EST VALIDE
    $sqlUtilisateurValide = "SELECT COUNT(valide_authentification) AS valid FROM authentification WHERE id_utilisateur = :id;";
    
    try{


        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlUtilisateurValide);
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $valid = $row['valid'];
        if($valid == 0){
            $reponse = '<h1>Vous devez avoir validé votre mail pour pouvoir souscrire</h1>';
        }


        else{
            //CALCUL DU PRIX
            $sqlPrixFormule = "SELECT prix_formule, nom_formule FROM formule WHERE id_formule = :id;";
            $resultat=0;
            $remise = 0;
            $duree = $_GET['duree'];
            $idAdhesion = intval($_GET['adhesion']);

            $ajoutTexte = '';
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($sqlPrixFormule);
            $stmt->bindParam(':id', $idAdhesion);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $formule = $stmt->fetch();
            switch($duree){
            case "1":
                $resultat = floatval($formule['prix_formule']);
            break;
            case "3":
                $remise= (floatval($formule['prix_formule']) * 0.05);
                $resultat = floatval($formule['prix_formule']);
                $resultat= ($resultat-$remise) * 3;
                $resultat = round($resultat, 2);
                $ajoutTexte = ", une remise de 5% a été appliquée sur un tarif mensuel de ".$formule['prix_formule']."€.";
            break;
            case "6":
                $remise= (floatval($formule['prix_formule']) * 0.08);
                $resultat = floatval($formule['prix_formule']);
                $resultat= ($resultat-$remise) * 6;
                $resultat = round($resultat, 2);
                $ajoutTexte = ", une remise de 8% a été appliquée sur un tarif mensuel de ".$formule['prix_formule']."€.";
            break;
            case "12":
                $remise= (floatval($formule['prix_formule']) * 0.12);
                $resultat = floatval($formule['prix_formule']);
                $resultat= ($resultat-$remise) * 12;
                $resultat = round($resultat, 2);
                $ajoutTexte = ", une remise de 12% a été appliquée sur un tarif mensuel de ".$formule['prix_formule']."€.";
            break;

            }
            // INFOS DANS SESSION
            $_SESSION['idFormule'] = $idAdhesion;
            $_SESSION['dureeFormule'] = intval($duree);
            $reponse = 'Une adhésion ' .$formule['nom_formule']. ' de '.$duree.' mois vous coutera '.$resultat.'€ '.$ajoutTexte.'<br>Validez vous votre adhésion ?<br><br>
            <form action="/verifications/validationAdhesion.php" method="GET">
                <input type="submit" name"validationAdhesion" value="Valider">
            </form>
            ';
        }
        echo $reponse;
    }

    catch(PDOException $err){
        die('Erreur : ' . $err->getMessage());
    }
}