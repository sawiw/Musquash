<?php
require_once('./sql/bddConnexion.php');

function debutEtFinSemaine($semaine, $annee) {
    $date = new DateTime();
    $ret['debutSemaine'] = $date->setISODate($annee, $semaine)->format('Y-m-d');
    $ret['finSemaine'] = $date->modify('+6 days')->format('Y-m-d');
    return $ret;
  }

// //FONCTIONNE
// function planning(int $terrain, int $semaine, int $annee): string{
//     $debutEtFin = debutEtFinSemaine($semaine,$annee);
//     $resultat = '';
//     $semaineCheck;
//     $cours = [];
//     $sqlRechercheCours = "SELECT groupe_cours_squash_collectif, horaire_cours_squash_collectif,cours_squash_collectif_nombre_participants_actuel FROM cours_squash_collectif WHERE id_terrain =:id AND (horaire_cours_squash_collectif BETWEEN :debut AND :fin)"; 
//     try{
//         $cnx = getBddConnexion();
//         $stmt = $cnx->prepare($sqlRechercheCours);
//         $stmt->bindParam(':id', $terrain);
//         $stmt->bindParam(':debut', $debutEtFin['debutSemaine']);
//         $stmt->bindParam(':fin', $debutEtFin['finSemaine']);
//         $stmt->execute();
//         $stmt->setFetchMode(PDO::FETCH_ASSOC);
//         while($adhesion = $stmt->fetch()){ 
//             $resultat.="Le cours prévu le ".$adhesion['horaire_cours_squash_collectif']." aura lieu sur le terrain n°".$terrain.", il y a ".$adhesion['cours_squash_collectif_nombre_participants_actuel'] . " inscrits<br><br>";
//             // array_push($_SESSION['formules'], $adhesion['libelle']);


            
//         }
//         return $resultat;
//     }
//     catch(PDOException $err){
//         die('Erreur : ' . $err->getMessage());
//     }
    
// }

// // Planning Boucle Originale
// function planning(int $terrain, int $semaine, int $annee): string{
//     //Jour début et jour fin
//     $debutEtFin = debutEtFinSemaine($semaine,$annee);
//     $resultat = '';
//     $heureCours;
//     $check= false;
//     $checkCoursAdulte = false;
//     $jourCours;
//     $libelleCours;
//     $cours = [];
//     $sqlRechercheCours = "SELECT groupe_cours_squash_collectif, horaire_cours_squash_collectif,cours_squash_collectif_nombre_participants_actuel FROM cours_squash_collectif WHERE id_terrain =:id AND (horaire_cours_squash_collectif BETWEEN :debut AND :fin)"; 
//     try{
//         $cnx = getBddConnexion();
//         $stmt = $cnx->prepare($sqlRechercheCours);
//         $stmt->bindParam(':id', $terrain);
//         $stmt->bindParam(':debut', $debutEtFin['debutSemaine']);
//         $stmt->bindParam(':fin', $debutEtFin['finSemaine']);
//         $stmt->execute();
//         $stmt->setFetchMode(PDO::FETCH_ASSOC);

//         //Array des crénaux pris par cours collectifs
//         while($adhesion = $stmt->fetch()){
//             switch($adhesion['groupe_cours_squash_collectif']){
//                 case 1:
//                     $libelleCours = "Cours enfants Groupe 1";
//                     break;
//                 case 2:
//                     $libelleCours = "Cours enfants Groupe 2";
//                     break;
//                 case 3:
//                     $libelleCours = "Cours enfants Groupe 3";
//                     break;
//                 case 4:
//                     $libelleCours = "Cours adulte débutant";
//                     break;
//                 case 5:
//                     $libelleCours = "Cours adulte confirmé";
//                     break;
//                 case 6:
//                     $libelleCours = "Cours adulte expert";
//                     break;
//                 default:
//                     $libelleCours = "Libre à la réservation";
//                     break;
//             }
//             $heureCours = new DateTime($adhesion['horaire_cours_squash_collectif']);
//             $heureCours = $heureCours->format('G');
//             $jourCours= new DateTime($adhesion['horaire_cours_squash_collectif']);
//             $jourCours = $jourCours->format('w');
//             array_push($cours, 
//             [$libelleCours,
//             $heureCours,
//             (10 - $adhesion['cours_squash_collectif_nombre_participants_actuel']),
//             $jourCours
//         ]);
//         }
//         //Début du tableau
//         $resultat.='
//         <style>
//             table {
//             border-collapse: collapse;
//             width: 85%;
//             height:85%;
//             }
//             tr td{ 
//             border: solid;
//             border-width: 1px;
//             }
//         </style>
        
//         <h1>PLANNING</h1>
//             <br>
//             <table>
//                 <thead>
//                     <tr>
//                         <th colspan="8">SEMAINE N°</th>
//                     </tr>
//                     <tr>
//                         <th>
//                             Heure / Jour
//                         </th>
//                         <th>Lundi</th>
//                         <th>Mardi</th>
//                         <th>Mercredi</th>
//                         <th>Jeudi</th>
//                         <th>Vendredi</th>
//                         <th>Samedi</th>
//                         <th>Dimanche</th>
//                     </tr>
//                 </thead>
//             <tbody>';

//         //CREATION TABLEAU
//         //Boucle heures (haut bas)
//         for($i = 9; $i<20; $i++){
//             $resultat .= '<tr>';
//             //Boucle jours (gauche droite)
//             for($y = 0; $y< 7; $y++){
//                 // if($checkCoursAdulte == true){
//                 //     $checkCoursAdulte = false;
//                 //     $i+=1;
//                 // }
//                 if($y==0){
//                     $resultat.='<td>'.$i.'h - '.($i+1).'h</td>';
//                 }
//                 if($y==6){
//                     $resultat.='<td>FERME</td>';
//                     break;
//                 }
                
//                 foreach($cours as $coursSeul){
                    
//                     //Si cours collectif
//                     if($coursSeul[1] == $i && $coursSeul[3]-1 == $y)
//                     {
//                         //si cours adulte et places restantes
//                         if(($coursSeul[0] == "Cours adulte débutant" || $coursSeul[0] == "Cours adulte confirmé" || $coursSeul[0] == "Cours adulte expert") && $coursSeul[2] > 0){
//                             $resultat.='<td rowspan="2" style="background-color: yellow;">'.$coursSeul[0].'<br>Places restantes : '.$coursSeul[2].'<br><button>S\'inscrire</button></td>';
//                             // ++$i;
//                             // ++$y;
//                             $check=true;
//                             // break;
//                         }
//                         //si cours adulte sans places restantes
//                         elseif(($coursSeul[0] == "Cours adulte débutant" || $coursSeul[0] == "Cours adulte confirmé" || $coursSeul[0] == "Cours adulte expert") && $coursSeul[2] <= 0){
//                             $resultat.='<td rowspan="2" style="background-color: grey;">'.$coursSeul[0].'<br>Cours complet</td>';
                            
//                             // $y+=1;
//                             $check=true;
//                             // break;
//                         }
//                         //si cours enfant avec place
//                         elseif(($coursSeul[0] == "Cours enfants Groupe 1" || $coursSeul[0] == "Cours enfants Groupe 2" || $coursSeul[0] == "Cours enfants Groupe 3") && $coursSeul[2] > 0){
//                             $resultat.='<td style="background-color: green;">'.$coursSeul[0].'<br>Places restantes : '.$coursSeul[2].'<br><button>S\'inscrire</button></td>';
//                             $check=true;
//                             // break;
//                         }
//                         //si cours enfant sans places
//                         else{
//                             $resultat.='<td style="background-color: grey;">'.$coursSeul[0].'<br>Cours complet</td>';
//                             $check=true;
//                             // break;
//                         }
//                     }
                    
//                 }
//                 if($check == true){
//                     $check = false;
//                     // break;
//                 }
//                 else{
//                     $resultat.='<td >Terrain libre <br><br><button>Reserver</button></td>';

//                 }
            
//             }
//             $resultat.='</tr>';
            
//         }
//         $resultat.='</tbody></table>';
//         print_r($cours);
//         return $resultat;
//     }
//     catch(PDOException $err){
//         die('Erreur : ' . $err->getMessage());
//     }
    
// }


// Planning Boucle Originale
function planning(int $terrain, int $semaine, int $annee): string{
    //Jour début et jour fin
    $debutEtFin = debutEtFinSemaine($semaine,$annee);
    $resultat = '';
    $heureCours;
    $check= false;
    $checkCoursAdulte = false;
    $jourCours;
    $libelleCours;
    $cours = [];
    $sqlRechercheCours = "SELECT groupe_cours_squash_collectif, horaire_cours_squash_collectif,cours_squash_collectif_nombre_participants_actuel FROM cours_squash_collectif WHERE id_terrain =:id AND (horaire_cours_squash_collectif BETWEEN :debut AND :fin)"; 
    try{
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($sqlRechercheCours);
        $stmt->bindParam(':id', $terrain);
        $stmt->bindParam(':debut', $debutEtFin['debutSemaine']);
        $stmt->bindParam(':fin', $debutEtFin['finSemaine']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        //Array des crénaux pris par cours collectifs
        while($adhesion = $stmt->fetch()){
            switch($adhesion['groupe_cours_squash_collectif']){
                case 1:
                    $libelleCours = "Cours enfants Groupe 1";
                    break;
                case 2:
                    $libelleCours = "Cours enfants Groupe 2";
                    break;
                case 3:
                    $libelleCours = "Cours enfants Groupe 3";
                    break;
                case 4:
                    $libelleCours = "Cours adulte débutant";
                    break;
                case 5:
                    $libelleCours = "Cours adulte confirmé";
                    break;
                case 6:
                    $libelleCours = "Cours adulte expert";
                    break;
                default:
                    $libelleCours = "Libre à la réservation";
                    break;
            }
            $heureCours = new DateTime($adhesion['horaire_cours_squash_collectif']);
            $heureCours = $heureCours->format('G');
            $jourCours= new DateTime($adhesion['horaire_cours_squash_collectif']);
            $jourCours = $jourCours->format('w');
            array_push($cours, 
            [$libelleCours,
            $heureCours,
            (10 - $adhesion['cours_squash_collectif_nombre_participants_actuel']),
            $jourCours
        ]);
        }
        //Début du tableau
        $resultat.='
        <style>
            table {
            border-collapse: collapse;
            width: 85%;
            height:85%;
            }
            tr td{ 
            border: solid;
            border-width: 1px;
            }
        </style>
        
        <h1>PLANNING</h1>
            <br>
            <table>
                <thead>
                    <tr>
                        <th colspan="8">SEMAINE N°</th>
                    </tr>
                    <tr>
                        <th>
                            Heure / Jour
                        </th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                        <th>Dimanche</th>
                    </tr>
                </thead>
            <tbody>';

        //CREATION TABLEAU
        //Boucle heures (haut bas)
        for($i = 9; $i<20; $i++){
            $resultat .= '<tr>';
            //Boucle jours (gauche droite)
            for($y = 0; $y< 7; $y++){
                // if($checkCoursAdulte == true){
                //     $checkCoursAdulte = false;
                //     $i+=1;
                // }
                if($y==0){
                    $resultat.='<td>'.$i.'h - '.($i+1).'h</td>';
                }
                if($y==6){
                    $resultat.='<td>FERME</td>';
                    break;
                }
                
                foreach($cours as $coursSeul){
                    
                    //Si cours collectif
                    if($coursSeul[1] == $i && $coursSeul[3]-1 == $y)
                    {
                        //si cours adulte et places restantes
                        if(($coursSeul[0] == "Cours adulte débutant" || $coursSeul[0] == "Cours adulte confirmé" || $coursSeul[0] == "Cours adulte expert") && $coursSeul[2] > 0){
                            $resultat.='<td rowspan="2" style="background-color: yellow;">'.$coursSeul[0].'<br>Places restantes : '.$coursSeul[2].'<br><button>S\'inscrire</button></td>';
                            // ++$i;
                            // ++$y;
                            $check=true;
                            // break;
                        }
                        //si cours adulte sans places restantes
                        elseif(($coursSeul[0] == "Cours adulte débutant" || $coursSeul[0] == "Cours adulte confirmé" || $coursSeul[0] == "Cours adulte expert") && $coursSeul[2] <= 0){
                            $resultat.='<td rowspan="2" style="background-color: grey;">'.$coursSeul[0].'<br>Cours complet</td>';
                            
                            // $y+=1;
                            $check=true;
                            // break;
                        }
                        //si cours enfant avec place
                        elseif(($coursSeul[0] == "Cours enfants Groupe 1" || $coursSeul[0] == "Cours enfants Groupe 2" || $coursSeul[0] == "Cours enfants Groupe 3") && $coursSeul[2] > 0){
                            $resultat.='<td style="background-color: green;">'.$coursSeul[0].'<br>Places restantes : '.$coursSeul[2].'<br><button>S\'inscrire</button></td>';
                            $check=true;
                            // break;
                        }
                        //si cours enfant sans places
                        else{
                            $resultat.='<td style="background-color: grey;">'.$coursSeul[0].'<br>Cours complet</td>';
                            $check=true;
                            // break;
                        }
                    }
                    
                }
                if($check == true){
                    $check = false;
                    // break;
                }
                else{
                    $resultat.='<td >Terrain libre <br><br><button>Reserver</button></td>';

                }
            
            }
            $resultat.='</tr>';
            
        }
        $resultat.='</tbody></table>';
        print_r($cours);
        return $resultat;
    }
    catch(PDOException $err){
        die('Erreur : ' . $err->getMessage());
    }
    
}

