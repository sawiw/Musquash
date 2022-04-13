<?php
session_start();
require('./sql/bddConnexion.php');
$verifMail = 'SELECT COUNT(*) as \'nb_mail\' from authentification where mail_authentification = :mail';
$verifMdp = 'SELECT `id_utilisateur`, `mdp_authentification`, `mail_authentification`, `login_authentification`,`valide_authentification` FROM `authentification` WHERE mail_authentification = :mail';

try{
    $cnx = getBddConnexion();
    $stmt = $cnx->prepare($verifMail);
    $stmt->bindParam(':mail', $_POST['mailConnexion']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $row = $stmt->fetch();
    $nb_mail = $row['nb_mail'];


    //Vérification que l'user existe
    if($nb_mail > 0){
        //Vérification du mot de passe
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($verifMdp);
        $stmt->bindParam(':mail', $_POST['mailConnexion']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $mdp = $stmt->fetch();
        
        //RAJOUTER LES INFOS À LA SESSION

        if($mdp['mdp_authentification'] == $_POST['mdpConnexion']){
            //echo 'Bienvenue ' . $_POST['loginAcc'];
            $_SESSION['id'] = $mdp['id_utilisateur'];
            $_SESSION['login'] = $mdp['login_authentification'];
            $_SESSION['mail'] = $mdp['mail_authentification'];
            $_SESSION['valide'] = $mdp['valide_authentification'];


            //VERIFICATION SI PROF
            $verifProf = 'SELECT COUNT(*) AS prof FROM utilisateur INNER JOIN prof ON utilisateur.id_utilisateur = prof.id_prof WHERE id_utilisateur = :id;'; 
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($verifProf);
            $stmt->bindParam(':id', $mdp['id_utilisateur']);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $prof = $row['prof'];

            if($prof > 0){
                $_SESSION['prof'] = true;
            }
            else{
                $_SESSION['prof'] = false; 
            }

            //VERIFICATION SI ADMIN
            $verifAdmin = 'SELECT COUNT(*) AS adminMus FROM authentification WHERE id_utilisateur = :id AND role_authentification = "admin";';
            $cnx = getBddConnexion();
            $stmt = $cnx->prepare($verifAdmin);
            $stmt->bindParam(':id', $mdp['id_utilisateur']);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $admin = $row['adminMus'];
            if($admin > 0){
                $_SESSION['admin'] = true;
            }
            else{
                $_SESSION['admin'] = false; 
            }

            header('Location: /index.php');  
        }
        else{
            //redirection à l'accueil
            header('Location: /index.php');  
            // echo("<script>alert('Mot de passe ou login erronné')</script>");    
            // echo 'Mot de passe ou login erronné';
        }
        
    }
    else{
        //redirection à l'accueil
        header('Location: /index.php');
        //echo("<script>alert('Mot de passe ou login erronné')</script>");    
        // echo 'Mot de passe ou login erronné';
    }

}

catch(PDOException $err){
    die('Erreur : ' . $err->getMessage());
}
