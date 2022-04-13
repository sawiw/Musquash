<?php
session_start();
require_once('../sql/bddConnexion.php');
$groupe = intval($_GET['groupe']);
$id = intval($_SESSION['id']);
$sqlGroupe = "UPDATE utilisateur
SET groupe_utilisateur = :groupe
WHERE id_utilisateur = :id;";
try{
    $cnx = getBddConnexion();
    $stmt = $cnx->prepare($sqlGroupe);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':groupe', $groupe);
    $stmt->execute();
    header('Location: /index.php');
}

catch(PDOException $err){
    die('Erreur : ' . $err->getMessage());          
}