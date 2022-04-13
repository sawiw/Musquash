<?php

require_once('../sql/bddConnexion.php');

function reservationTerrain($idUtilisateur, $idTerrain, $date): string 
{
    //VERIFICATION SI ADHERENT
    $sqlVerifAdhere = "SELECT COUNT(id_formule) AS adhere FROM utilisateur_formule WHERE id_utilisateur = :id AND id_formule = 3";

    $sqlReserveTerrain = 'INSERT INTO planning_reservation (horaire_planning_reservation, type_reservation, id_utilisateur, id_terrain, cours_individuel_bloque) VALUES
    (:dateReservation, "ReservationTerrain", :idUtilisateur, :idTerrain, 1);
    ';

    try{
        //CHECK SI USER DÉJÀ INSCRIT AUTRE COURS
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlVerifAdhere);
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $adhere = $row['adhere'];
        // $dateReserv = date("Y-m-d H:i:s");
        if($adhere>0){
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($sqlReserveTerrain);
            $stmt->bindParam(':idUtilisateur', $_SESSION['id']);
            $stmt->bindParam(':dateReservation', $date);
            $stmt->bindParam(':idTerrain', $idTerrain);
            $stmt->execute();
            return'<h1>Merci pour votre réservation, cela vous coutera 9.99€</h1><br><form action="/planning.php" method="POST">
            <input type="submit" value="Retour au planning">
            </form><br><form action="/index.php" method="POST">
            <input type="submit" value="Retour à l\'accueil">
            </form>';
        }
        else{
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($sqlReserveTerrain);
            $stmt->bindParam(':idUtilisateur', $_SESSION['id']);
            $stmt->bindParam(':dateReservation', $date);
            $stmt->bindParam(':idTerrain', $idTerrain);
            $stmt->execute();
            return'<h1>Merci pour votre réservation, cela vous coutera 9.99€</h1><br><form action="/planning.php" method="POST">
            <input type="submit" value="Retour au planning">
            </form><br><form action="/index.php" method="POST">
            <input type="submit" value="Retour à l\'accueil">
            </form>';
        }
        

        
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