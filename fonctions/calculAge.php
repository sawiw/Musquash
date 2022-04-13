<?php

require_once('../sql/bddConnexion.php');
function calculAge($id): int{
    $timezone  = new DateTimeZone('Europe/Paris');
    $sqlDateNaissance = "SELECT date_naissance FROM utilisateur WHERE id_utilisateur = :id";
    try{
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlDateNaissance);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $dateNaissance = $stmt->fetch();
    
        $age = DateTime::createFromFormat('Y-m-d', $dateNaissance['date_naissance'], $timezone)
        ->diff(new DateTime('now', $timezone))
        ->y;
        return $age;
    }
    
    catch(PDOException $err){
        die('Erreur : ' . $err->getMessage());
    }
}