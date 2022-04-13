<?php
session_start();
require_once('../sql/bddConnexion.php');
require_once('../fonctions/calculAge.php');
if(!array_key_exists('dureeFormule', $_SESSION) || !array_key_exists('idFormule', $_SESSION)){
    echo'La page demandée n\'existe pas';
}
else{
    try{
        $date = date('Y-m-d ');
        $sqlAdhesion = 'INSERT INTO utilisateur_formule (id_utilisateur, id_formule, date_adhesion, duree_mois) VALUES (:idUtilisateur, :idFormule, :dateAdhesion, :duree);';

        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlAdhesion);
        $stmt->bindParam(':idUtilisateur', $_SESSION['id']);
        $stmt->bindParam(':idFormule', $_SESSION['idFormule']);
        $stmt->bindParam(':dateAdhesion', $date);
        $stmt->bindParam(':duree', $_SESSION['dureeFormule']);
        $stmt->execute();
        
        $reponse='';
        $age = calculAge(intval($_SESSION['id']));
        
        // echo '<br>';
        // echo $_SESSION['idFormule'];
        // echo gettype($_SESSION['idFormule']);
        if(intval($_SESSION['idFormule']) == 1 && $age > 17){
            
            
            echo 'Vous avez souscrit à une formule pour des cours de squash collectifs<br>Il vous faut maintenant choisir un groupe en fonction de votre niveau<br><br>
                
            <form action="/verifications/traitementGroupeSquash.php" method="GET">
                <label for="groupeAdDeb">Groupe Adulte Débutant</label>
                <input type="radio" name="groupe" value="4" id="groupeAdDeb" required><br>
                
                <label for="groupeAdConfirme">Groupe Adulte Confirmé</label>
                <input type="radio" name="groupe" value="5" id="groupeAdConfirme"><br>
                
                <label for="groupeAdAvance">Groupe Adulte Avancé</label>
                <input type="radio" name="groupe" value="6" id="groupeAdAvance"><br><br>
                
                <input type="submit" name"validationAdhesion" value="Valider et retourner à l\'accueil">
            </form>
            '; 
        }
        elseif(intval($_SESSION['idFormule']) == 1 && $age <= 17){
            echo'entré dans le if enfant';
            $sqlGroupeEnfant = "UPDATE utilisateur
            SET groupe_utilisateur = :groupe
            WHERE id_utilisateur = :id;";
            $id = intval($_SESSION['id']);
            $groupe = 0;
            switch($age) {
                case $age > 10 and $age <= 13:
                    $groupe = 2;
                    break;
                case $age > 13 and $age <= 17:
                    $groupe = 3;
                    break;
                default:
                    $groupe = 1;
                    break;
            }
            try{
                $cnx = getBddConnexion();
                $stmt = $cnx->prepare($sqlGroupeEnfant);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':groupe', $groupe);
                $stmt->execute();
                header('Location: /index.php');
            }
            
            catch(PDOException $err){
                die('Erreur : ' . $err->getMessage());          
            }

        }
        else{
           echo  'Merci à vous, nous vous confirmons votre adhésion ! 
        <br><br>
        <form action="/index.php" method="post">
            <input type="submit" value="Retour à l\'accueil">
        </form>';
        }
        return $reponse;
    }

    catch(PDOException $err){
        echo'Vous avez déjà souscrit à cette formule ! 
        <br><br>
        <form action="/index.php" method="post">
            <input type="submit" value="Retour à l\'accueil">
        </form>';
    }
}