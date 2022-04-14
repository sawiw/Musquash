<?php

require_once('../sql/bddConnexion.php');


function reservationCoursColl($idUtilisateur, $idCours): string
{
    //Verif si déjà inscrit dans un/des cours
    $sqlVerifCours = "SELECT COUNT(id_cours_squash_collectif) AS nbCours FROM utilisateur_cours_squash_collectif WHERE id_utilisateur = :idCheck";

    //check la semaine du dernier cours
    $sqlSemaineDernierCoursInscrit = "SELECT MAX(horaire_cours_squash_collectif) FROM utilisateur_cours_squash_collectif NATURAL JOIN cours_squash_collectif WHERE id_utilisateur = :idUtilisateurCheck";

    //Verifier par rapport au cours où il veut s'inscrire
    $sqlSemaineCoursActu ="SELECT horaire_cours_squash_collectif FROM cours_squash_collectif WHERE id_cours_squash_collectif = :idCoursActu";
    
    //Ajouter les données
    $sqlAjouterCours = "INSERT INTO utilisateur_cours_squash_collectif (id_utilisateur, id_cours_squash_collectif) VALUES (:idUtilisateur, :idCoursAssoc);
    UPDATE cours_squash_collectif SET cours_squash_collectif_nombre_participants_actuel = cours_squash_collectif_nombre_participants_actuel + 1 WHERE id_cours_squash_collectif = :idCours";

    try{
        //CHECK SI USER DÉJÀ INSCRIT AUTRE COURS
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlVerifCours);
        $stmt->bindParam(':idCheck', $idUtilisateur);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $nbCours = $row['nbCours'];
        if($nbCours == 0) {
            //AJOUT DONNÉES
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($sqlAjouterCours);
            $stmt->bindParam(':idCoursAssoc', $idCours);
            $stmt->bindParam(':idCours', $idCours);
            $stmt->bindParam(':idUtilisateur', $idUtilisateur);
            $stmt->execute();
            return'<h1>Merci pour votre inscription à ce cours !</h1><br>
            <form action="/planning.php" method="POST">
            <input type="submit" value="Retour au planning">
            </form><br><form action="/index.php" method="POST">
            <input type="submit" value="Retour à l\'accueil">
            </form>';
        }
        else{
            //CHECK SEMAINE DU DERNIER COURS
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($sqlSemaineDernierCoursInscrit);
            $stmt->bindParam(':idUtilisateurCheck', $idUtilisateur);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($cours = $stmt->fetch()){
                $date =$cours['MAX(horaire_cours_squash_collectif)'];
                $datePlus = new DateTime($date);
                $derniereSemaine = $datePlus->format("W");
            }
            //CHECK SEMAINE COURS ACTUEL
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($sqlSemaineCoursActu);
            $stmt->bindParam(':idCoursActu', $idCours);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($cours = $stmt->fetch()){
                $dateD =$cours['horaire_cours_squash_collectif'];
                $datePlusD = new DateTime($dateD);
                $semaineCours = $datePlusD->format("W");
            }

            //SI CE NE SONT PAS LES MÊMES, INSERT LES DONNÉES
            if($derniereSemaine != $semaineCours){
                $cnx = getBddConnexion();
                $stmt = $cnx->prepare($sqlAjouterCours);
                $stmt->bindParam(':idCoursAssoc', $idCours);
                $stmt->bindParam(':idCours', $idCours);
                $stmt->bindParam(':idUtilisateur', $idUtilisateur);
                $stmt->execute();
                return'<h1>Merci pour votre inscription à ce cours !</h1><br>
                <form action="/planning.php" method="POST">
                <input type="submit" value="Retour au planning">
                </form><br><form action="/index.php" method="POST">
                <input type="submit" value="Retour à l\'accueil">
                </form>';
            }
            //SINON, PAS DE COURS
            else{
                return'<h1>Désolé, vous êtes déjà inscrit à un cours cette semaine</h1><br>
                <form action="/planning.php" method="POST">
                <input type="submit" value="Retour au planning">
                </form><br><form action="/index.php" method="POST">
                <input type="submit" value="Retour à l\'accueil">
                </form>';
            }
        }

        
    }

    catch(PDOException $err){
        return'<h1>Vous êtes déjà inscrit pour ce cours</h1><br><form action="/planning.php" method="POST">
        <input type="submit" value="Retour au planning">
        </form><br><form action="/index.php" method="POST">
        <input type="submit" value="Retour à l\'accueil">
        </form>';


    }
}