<?php

require_once('../sql/bddConnexion.php');

function preReservation($idProf, $idTerrain, $date): string 
{

    $sqlPreReserve = 'INSERT INTO planning_reservation (horaire_planning_reservation, type_reservation, id_utilisateur, id_terrain, cours_individuel_bloque) VALUES
    (:dateReservation, "PreReservation", :idProf, :idTerrain, 0);
    ';

    try{
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlPreReserve);
        $stmt->bindParam(':idProf', $_SESSION['id']);
        $stmt->bindParam(':dateReservation', $date);
        $stmt->bindParam(':idTerrain', $idTerrain);
        $stmt->execute();
        return'<h1>Votre créneau a bien été pris en compte</h1><br><form action="/planning.php" method="POST">
        <input type="submit" value="Retour au planning">
        </form><br><form action="/index.php" method="POST">
        <input type="submit" value="Retour à l\'accueil">
        </form>';
    }
        

    

    catch(PDOException $err){
        // return'<h1>Vous ne pouvez pas réserver ce terrain</h1><br><form action="/planning.php" method="POST">
        // <input type="submit" value="Retour au planning">
        // </form><br><form action="/index.php" method="POST">
        // <input type="submit" value="Retour à l\'accueil">
        // </form>';
        die('Erreur : ' . $err->getMessage());


    }
}