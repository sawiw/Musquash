<?php

require_once('../sql/bddConnexion.php');

function reservationCoursInd($idProf, $idTerrain, $date): string 
{

    $sqlCoursInd = 'INSERT INTO planning_reservation (horaire_planning_reservation, type_reservation, id_utilisateur, id_terrain, cours_individuel_bloque) VALUES
    (:dateReservation, "ReservationInd", :idUser, :idTerrain, 1);
    UPDATE planning_reservation SET cours_individuel_bloque = 1 WHERE id_terrain = :idTerrain AND horaire_planning_reservation = :dateReservation AND type_reservation = \'PreReservation\'
    ';

    try{
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlCoursInd);
        $stmt->bindParam(':idUser', $_SESSION['id']);
        $stmt->bindParam(':dateReservation', $date);
        $stmt->bindParam(':idTerrain', $idTerrain);
        $stmt->execute();
        return'<h1>Vous êtes bien inscrit en cours individuel pour ce créneau, merci à vous !</h1><br><form action="/planning.php" method="POST">
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