<?php
require_once('./sql/bddConnexion.php');

function prixAdhesion($idFormule, $duree): float{
    $sqlPrixFormule = "SELECT prix_formule FROM formule WHERE id_formule = :id;";
    $resultat='';
    
    try{
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlPrixFormule);
        $stmt->bindParam(':id', $idFormule);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $formule = $stmt->fetch();

        switch($duree){
            case "1":
                $resultat = $formule['prix_formule'];
                break;

        }
        
        return floatval($resultat);
    }
    catch(PDOException $err){
        die('Erreur : ' . $err->getMessage());
    }
}