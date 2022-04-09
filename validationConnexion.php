<?php
session_start();
require('./sql/bddConnexion.php');
$verifMail = 'select count(*) as \'nb_mail\' from authentification where mail_authentification = :mail';
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
            
            header('Location: index.php');  
        }
        else{
            //redirection à l'accueil
            header('Location: index.php');  
            // echo("<script>alert('Mot de passe ou login erronné')</script>");    
            // echo 'Mot de passe ou login erronné';
        }
        
    }
    else{
        //redirection à l'accueil
        header('Location: index.php');
        //echo("<script>alert('Mot de passe ou login erronné')</script>");    
        // echo 'Mot de passe ou login erronné';
    }

}

catch(PDOException $err){
    die('Erreur : ' . $err->getMessage());
}
