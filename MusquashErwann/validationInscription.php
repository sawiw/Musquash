<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once('./sql/bddConnexion.php');
require_once('dossierIncludes\PHPMailer\Exception.php');
require_once('dossierIncludes\PHPMailer\PHPMailer.php');
require_once('dossierIncludes\PHPMailer\SMTP.php');



// FONCTION CREATION DU MOT DE PASSE PROVISOIRE
function creationMdp():string{
    $char = ["a","z","e","r","t","y","u","i","o","p","n","b","v","c","x","w","q","s","d","f","g","m","l","k","j","h","&","é","\"","'","(","-","è","_","ç","à",")","=","%","^","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","9","8","7","6","5","4","3","2","1","0"];
    $longueurChar = count($char) - 1;
    $longueurMdp = random_int(8, 10);
    $mdp = [];
    for($i = 0; $i<= $longueurMdp; $i++){
        array_push($mdp, $char[random_int(0, $longueurChar)]);
    }
    $mdp = implode($mdp);
    //var_dump($mdp);
    return $mdp;
}




$motDePasse = creationMdp();
// Requetes de verification login et mail
$verifLogin = 'select count(*) as \'nb_login\' from authentification where login_authentification = :login';
$verifMail = 'select count(*) as \'nb_mail\' from authentification where mail_authentification = :mail';
// Verif ID + variable du futur ID
$idArray = [];
$verifId = 'SELECT id_utilisateur FROM utilisateur;';
$idUtilisateur = 1;


// On compte le nombre de lignes contenant le login
$cnx = getBddConnexion();
$stmt = $cnx->prepare($verifLogin);
$stmt->bindParam(':login', $_POST['login']);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$row = $stmt->fetch();
$nb_login = $row['nb_login'];

// On coupe si le login existe
if($nb_login > 0){
    echo '<p>Le login "'. $_POST['login'] .'" existe déjà !</p>
    <br><br>
    <form action="/index.php" method="post">
        <input type="submit" value="Retour à l\'accueil">
    </form>';
}

// Sinon, on verifie le mail 
else{
    // On compte le nombre de lignes contenant le mail
    $cnx = getBddConnexion();
    $stmt = $cnx->prepare($verifMail);
    $stmt->bindParam(':mail', $_POST['mail']);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $row = $stmt->fetch();
    $nb_mail = $row['nb_mail'];

    // On coupe si le mail existe
    if($nb_mail > 0){
        echo '<p>Le mail "'. $_POST['mail'] .'" possède déjà un compte chez Musquash</p>
        <br><br>
        <form action="/index.php" method="post">
            <input type="submit" value="Retour à l\'accueil">
        </form>';
    }

    // On peut lancer l'inscription en BDD
    else{
        // Check ID
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($verifId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()){
            array_push($idArray, $row['id_utilisateur']);
        }
        
        // Vérification longueur de l'array, si elle est vide l'ID reste 1
        $idArrayLength = count($idArray);
        if($idArrayLength > 0){
            for($i = 0; $i<$idArrayLength; $i++){
                if(array_key_exists(($i+1), $idArray) == false ||($idArray[$i] + 1) != $idArray[($i+1)]){
                    
                    $idUtilisateur = ($idArray[$i] + 1);
                    break;
                }
            }
        }
        
        
        try{
            // Requete enregistrement BDD
            $enregitrerClient = 
            'INSERT INTO utilisateur (`id_utilisateur`,`nom_utilisateur`, `prenom_utilisateur`, `date_naissance`, `groupe_utilisateur`) 
            VALUES (:id, :nom, :prenom, :dateNaissance, NULL);
            
            INSERT INTO authentification (`mail_authentification`, `mdp_authentification`, `login_authentification`, `role_authentification`, `id_utilisateur`, `valide_authentification`)
            VALUES (:mail, :mdp, :login, "utilisateur", :id, false);
            ';

            // Inscription dans la bdd
            $stmt = $cnx->prepare($enregitrerClient);
            $stmt->bindParam(':id', $idUtilisateur);
            $stmt->bindParam(':nom', $_POST['nom']);
            $stmt->bindParam(':prenom', $_POST['prenom']);
            $stmt->bindParam(':dateNaissance', $_POST['dateNaissance']);
            $stmt->bindParam(':mail', $_POST['mail']);
            $stmt->bindParam(':login', $_POST['login']);
            $stmt->bindParam(':mdp', $motDePasse);
            $stmt->execute();

            // // Envoi du mail 
            

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'equipemusquash@gmail.com';                     //SMTP username
                $mail->Password   = 'AZev123bc4ersani';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('equipemusquash@gmail.com', 'Equipe Musquash');
                $mail->addAddress($_POST['mail'], $_POST['nom'].' '.$_POST['prenom']);     //Add a recipient
                

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Hey '.$_POST['login'].' ! Bienvenue chez Musquash !';
                $mail->Body    = 'Bonjour '.$_POST['prenom']. ' ' .$_POST['nom'].' <br>Voici vos identifiants Musquash, le mot de passe provisoire vous servira à paramètrer votre mot de passe définitif et ainsi valider votre inscription <br>Mot de passe provisoire : '.$motDePasse.'<br>À très vite chez Musquash !<br><br>L\'équipe Musquash';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Un mail vous a été envoyé sur ' . $_POST['mail'] . '<br>Pensez à vous connecter et changer votre mot de passe pour valider votre compte<br>
                <form action="/index.php" method="post">
                    <input type="submit" value="Retour à l\'accueil">
                </form>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
            
        }
        catch(PDOException $err){
            die('Erreur : ' . $err->getMessage());
        }
    }
}
?>