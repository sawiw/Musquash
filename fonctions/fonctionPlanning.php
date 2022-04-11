<?php
// À REGLER : NE FONCTIONNE PAS SI PAS DE COURS (FAIRE UN COUNT ?)


require_once('./sql/bddConnexion.php');

function debutEtFinSemaine($semaine, $annee) {
    $date = new DateTime();
    $ret['debutSemaine'] = $date->setISODate($annee, $semaine)->format('Y-m-d');
    $ret['finSemaine'] = $date->modify('+6 days')->format('Y-m-d');
    return $ret;
  }

// Planning Boucle Originale
function planning(int $terrain, int $semaine, int $annee): string{
    //Jour début et jour fin
    $debutEtFin = debutEtFinSemaine($semaine,$annee);
    $resultat = '';
    $heureCours;
    $check= false;
    $jourCours;
    $libelleCours;
    $cours = [];
    //Count pour vérifier qu'il y a des cours (sinon le fatal error pour afficher le planning)
    $countCoursSemaine = "SELECT COUNT(horaire_cours_squash_collectif) AS nb_cours FROM cours_squash_collectif WHERE id_terrain =:id AND (horaire_cours_squash_collectif BETWEEN :debut AND :fin)";

    $sqlRechercheCours = "SELECT groupe_cours_squash_collectif, horaire_cours_squash_collectif,cours_squash_collectif_nombre_participants_actuel FROM cours_squash_collectif WHERE id_terrain =:id AND (horaire_cours_squash_collectif BETWEEN :debut AND :fin)"; 
    try{
        $cnx = getBddConnexion();
        $stmt = $cnx->prepare($countCoursSemaine);
        $stmt->bindParam(':id', $terrain);
        $stmt->bindParam(':debut', $debutEtFin['debutSemaine']);
        $stmt->bindParam(':fin', $debutEtFin['finSemaine']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $nb_cours = $row['nb_cours'];

        //SI COURS > 0 :
        if($nb_cours>0){
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
                $heurePrecedente =-1;

                $terrainSuivant = 0;
                $terrainPrecedent = 0;
                if($terrain == 1){
                    $terrainPrecedent = 6;
                    $terrainSuivant = 2;
                }
                elseif($terrain == 6){
                    $terrainSuivant = 1;
                }
                else{
                    $terrainSuivant = $terrain+1;
                    $terrainPrecedent = $terrain-1;
                }
                $semaineSuivante = 0;
                $semainePrecedente = 0;
                if($semaine == 1){
                    $semainePrecedente = 52;
                    $semaineSuivante = 2;
                }
                elseif($semaine == 52){
                    $semaineSuivante = 1;
                    $semainePrecedente = 51;
                }
                else{
                    $semaineSuivante = $semaine+1;
                    $semainePrecedente = $semaine-1;
                }

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
            
            <h1>PLANNING MUSQUASH 2022</h1>
                <br>
                <table>
                    <thead>
                        <tr>

                            <th style="border: solid black 3px;"colspan="4">
                            
                                <form action="planning.php" method="GET">
                                    <input type="hidden" name="semaine" value="'.$semainePrecedente.'">
                                    <input type="submit" name="test" value="Semaine n°'.$semainePrecedente.'">
                                </form>
                                &nbsp;&nbsp;SEMAINE N°'.$semaine.' (du '.$debutEtFin['debutSemaine'].' au '.$debutEtFin['finSemaine'].')&nbsp;&nbsp;
                                <form action="planning.php" method="GET">
                                    <input type="hidden" name="semaine" value="'.$semaineSuivante.'">
                                    <input type="submit" name="test" value="Semaine n°'.$semaineSuivante.'">
                                </form>

                            </th>

                            <th style="border: solid black 3px;"colspan="4">

                            <form action="planning.php" method="GET">
                                <input type="hidden" name="semaine" value="'.$semaine.'">
                                <input type="hidden" name="terrain" value="'.$terrainPrecedent.'">
                                <input type="submit" name="test" value="Terrain n°'.$terrainPrecedent.'">
                            </form>
                            &nbsp;&nbsp;TERRAIN N°'.$terrain.'&nbsp;&nbsp;
                            <form action="planning.php" method="GET">
                                <input type="hidden" name="semaine" value="'.$semaine.'">
                                <input type="hidden" name="terrain" value="'.$terrainSuivant.'">
                                <input type="submit" name="test" value="Terrain n°'.$terrainSuivant.'">
                            </form>

                            </th>

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
                    
                    if($y==0){
                        $resultat.='<td>'.$i.'h - '.($i+1).'h</td>';
                    }
                    if($i == $heurePrecedente){
                        $y+=1;
                        $heurePrecedente = -1;
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
                                //Rajouter l'heure précedente pour sauter une case
                                $heurePrecedente = $i+1;
                                $check=true;
                            }
                            //si cours adulte sans places restantes
                            elseif(($coursSeul[0] == "Cours adulte débutant" || $coursSeul[0] == "Cours adulte confirmé" || $coursSeul[0] == "Cours adulte expert") && $coursSeul[2] <= 0){
                                $resultat.='<td rowspan="2" style="background-color: grey;">'.$coursSeul[0].'<br>Cours complet</td>';
                                //Rajouter l'heure précedente pour sauter une case
                                $heurePrecedente = $i+1;
                                $check=true;
                            }
                            //si cours enfant avec place
                            elseif(($coursSeul[0] == "Cours enfants Groupe 1" || $coursSeul[0] == "Cours enfants Groupe 2" || $coursSeul[0] == "Cours enfants Groupe 3") && $coursSeul[2] > 0){
                                $resultat.='<td style="background-color: green;">'.$coursSeul[0].'<br>Places restantes : '.$coursSeul[2].'<br><button>S\'inscrire</button></td>';
                                $check=true;
                            }
                            //si cours enfant sans places
                            else{
                                $resultat.='<td style="background-color: grey;">'.$coursSeul[0].'<br>Cours complet</td>';
                                $check=true;
                            }
                        }
                        
                    }
                    if($check == true){
                        $check = false;
                    }
                    else{
                        $resultat.='<td >Terrain libre <br><br><button>Reserver</button></td> ';

                    }
                
                }
                $resultat.='</tr>';
                
            }
            $resultat.='</tbody></table>';
            // print_r($cours);
            return $resultat;
        }

        // SI PAS DE COURS
        else{
            $terrainSuivant = 0;
            $terrainPrecedent = 0;
            if($terrain == 1){
                $terrainPrecedent = 6;
                $terrainSuivant = 2;
            }
            elseif($terrain == 6){
                $terrainPrecedent = 5;
                $terrainSuivant = 1;
            }
            else{
                $terrainSuivant = $terrain+1;
                $terrainPrecedent = $terrain-1;
            }
            $semaineSuivante = 0;
            $semainePrecedente = 0;
            if($semaine == 1){
                $semainePrecedente = 52;
                $semaineSuivante = 2;
            }
            elseif($semaine == 52){
                $semaineSuivante = 1;
                $semainePrecedente = 51;
            }
            else{
                $semaineSuivante = $semaine+1;
                $semainePrecedente = $semaine-1;
            }
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
            
            <h1>PLANNING MUSQUASH 2022</h1>
                <br>
                <table>
                    <thead>
                        <tr>

                        <th style="border: solid black 3px;"colspan="4">
                            
                        <form action="planning.php" method="GET">
                            <input type="hidden" name="semaine" value="'.$semainePrecedente.'">
                            <input type="submit" name="test" value="Semaine n°'.$semainePrecedente.'">
                        </form>
                        &nbsp;&nbsp;SEMAINE N°'.$semaine.' (du '.$debutEtFin['debutSemaine'].' au '.$debutEtFin['finSemaine'].')&nbsp;&nbsp;
                        <form action="planning.php" method="GET">
                            <input type="hidden" name="semaine" value="'.$semaineSuivante.'">
                            <input type="submit" name="test" value="Semaine n°'.$semaineSuivante.'">
                        </form>

                    </th>

                    <th style="border: solid black 3px;"colspan="4">

                    <form action="planning.php" method="GET">
                        <input type="hidden" name="semaine" value="'.$semaine.'">
                        <input type="hidden" name="terrain" value="'.$terrainPrecedent.'">
                        <input type="submit" name="test" value="Terrain n°'.$terrainPrecedent.'">
                    </form>
                    &nbsp;&nbsp;TERRAIN N°'.$terrain.'&nbsp;&nbsp;
                    <form action="planning.php" method="GET">
                        <input type="hidden" name="semaine" value="'.$semaine.'">
                        <input type="hidden" name="terrain" value="'.$terrainSuivant.'">
                        <input type="submit" name="test" value="Terrain n°'.$terrainSuivant.'">
                    </form>

                    </th>

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
                for($i = 9; $i<20; $i++){
                    $resultat .= '<tr>';
                    for($j = 0; $j<7; $j++){
                        if($j==0){
                            $resultat.='<td>'.$i.'h - '.($i+1).'h</td>';
                        }
                        if($j==6){
                            $resultat.='<td>FERME</td>';
                            break;
                        }
                        else{
                            $resultat.='<td >Terrain libre <br><br><button>Reserver</button></td> ';
    
                        }
                    }
                    $resultat.='</tr>';
                }
                $resultat.='</tbody></table>';
                return $resultat;
        }
    }

    catch(PDOException $err){
        die('Erreur : ' . $err->getMessage());
    }
    
    
   
}


