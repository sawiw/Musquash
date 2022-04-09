<?php
session_start();
require('./sql/bddConnexion.php');
$updateMdp = 'UPDATE authentification
SET mdp_authentification =:mdp, valide_authentification = true
WHERE id_utilisateur =:id;';

$validerSession = 'SELECT valide_authentification FROM authentification WHERE id_utilisateur =:id;';


try{
    $cnx = getBddConnexion();
    $stmt = $cnx->prepare($updateMdp);
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->bindParam(':mdp', $_POST['modifMdp1']);
    $stmt->execute();

    $cnx = getBddConnexion();
    $stmt = $cnx->prepare($validerSession);
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $valid = $stmt->fetch();
    $_SESSION['valide'] = $valid['valide_authentification'];


    header('Location: /musquash/compteUtilisateur.php');
}

catch(PDOException $err){
    die('Erreur : ' . $err->getMessage());
}
?>