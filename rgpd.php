<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  
  <title>Musquash</title>
</head>
<body>
<?php
if(array_key_exists('login', $_SESSION)){
    echo 'Connecté en tant que : ' . $_SESSION['login'] ;
    include('dossierIncludes\barreNavCo.php');
}
else{
    echo 'Non connecté
    ';
    include('dossierIncludes/barreNavNonCo.php');
}
?>
<title>Musquash-Condition-générale-utilisation</title>

<div class="container-rgpd">
    <p id="text-rgpd">
      <strong> Obligations légales sur le respect des données personnelles</strong><br><br>
      .1 L’Administrateur s’engage à utiliser le Site et les Services conformément aux présentes conditions générales
       et sans enfreindre les lois et règlements en vigueur, l’ordre public ou les droits de tiers.<br>
      Il est notamment interdit à l’Administrateur d’utiliser une marque ou une dénomination protégée dans le nom,
       l’adresse, la description ou les mots clefs du site internet.<br>
      .2 L’Administrateur est seul responsable de la création et de la gestion de son site internet, ainsi que de la gestion
       des Membres de celui-ci.<br>
      Il s’engage à respecter toutes les obligations légales et réglementaires qui lui incombent de ce fait
       (voir en particulier l’article 11 pour ce qui concerne les données à caractère personnel).<br>
      .3 L’Administrateur s’engage à veiller à ce que son site internet ne porte pas atteinte aux lois et règlements,
      aux droits des tiers, à l’ordre public ou aux bonne mœurs.<br>
      1. Données personnelles des Membres (co-traitance)<br>
      1.1 Dans le cadre de la mise en œuvre des Services, Musquash et l’Administrateur sont amenés à collecter et à traiter
      certaines données à caractère personnel des Membres.<br>
       A cette fin, Musquash et l’Administrateur s’engagent, chacun pour ce qui le concerne, à se conformer à la réglementation
       applicable aux données à caractère personnel et en particulier au règlement général sur la protection des données
       (règlement UE 2016/679 du Parlement européen et du Conseil du 27 avril 2016 – ci-après : le « RGPD »).<br>
      1.2 Musquash et l’Administrateur définissent conjointement les finalités et les moyens des traitements de données à caractère
       personnel des Membres dans le cadre des Forums. En effet, Musquash détermine les moyens essentiels du traitement tels que,
       sans que cette liste ne soit exhaustive, l’architecture technique de la plateforme, ou les durées de conservation des données.<br>
       L’Administrateur détermine quant à lui notamment les catégories de données traitées.<br>
       Musquash et l’Administrateur sont ainsi placés dans une situation de co-traitance et doivent être considérés comme des responsables<br>
        conjoints du traitement.<br>
      1.3 Musquash et l’Administrateur, en leur qualité de responsables conjoints du traitement, s’engagent à mettre en œuvre toutes
       les mesures raisonnables permettant de se conformer à la réglementation applicable à la protection des données personnelles,
       en particulier au RGPD, et se répartissent leurs obligations respectives, notamment :<br>
      • L’Administrateur s’engage à minimiser la collecte des données, dans le respect des principes posés par le RGPD. Il est seul
       responsable des données qu’il décide de collecter et, le cas échéant, de recueillir le consentement des Membres à cette fin
        si un tel consentement est nécessaire en application du RGPD, en particulier en cas de collecte de données sensibles telles que,
        sans que cette liste soit exhaustive, les données relatives à l’origine raciale ou ethnique, à la santé, à la religion,
        à la vie ou aux orientations sexuelles, aux opinions politiques ou philosophiques ou encore à l’appartenance syndicale
        des Membres. Il peut mettre en place la demande de consentement et l’information correspondante à travers son panneau
        d’administration ou par tout autre moyen utile. La collecte de données relatives aux infractions ou condamnations pénales
        est en tout état de cause strictement interdite.<br>
      • Musquash effectue l’information des Membres sur le traitement à travers la « Charte de Confidentialité » telle qu’elle est
       publiée sur le Site (voir article 26). L’Administrateur déclare être informé que cette Charte de Confidentialité s’applique à
        tous le site de manière globale, sans prendre en compte les spécificités de chaque traitement. Dès lors, si compte tenu
        des données que l’Administrateur décide de traiter, l’information contenue dans la Charte de Confidentialité s’avère insuffisante,
        il appartient à l’Administrateur de compléter lui-même cette information auprès des Membres à travers le panneau d’administration
        de son site internet ou par tout autre moyen utile, de manière claire, transparente et facilement accessible.<br>
      • L’Administrateur a la possibilité de mettre en place des cookies sur son Forum.<br>
       Il lui appartient dans ce cas de mettre en place l’information appropriée des Membres ainsi que le recueil de leur consentement
        à travers le panneau d’administration de son site internet ou par tout autre moyen utile.
      • L’Administrateur est le contact des Membres pour toute demande relative à leurs données. Il lui appartient de répondre à ces
       demandes dans les meilleurs délais.<br>
      • Musquash et L’Administrateur s’interdisent d’effectuer tout traitement ultérieur incompatible avec les finalités explicitement
       déterminées dans la Charte de Confidentialité.<br>
      • Musquash et L’Administrateur s’engagent respectivement à adopter des mesures de sécurité d’ordre technique et organisationnel
       appropriées eu égard aux risques inhérents aux traitements et à la nature des données à caractère personnel concernées.<br>
      1.4 Les dispositions du présent article s’appliquent uniquement aux traitements effectués dans le cadre des Forums,
      à l’exclusion de tout autre traitement susceptible d’être effectué à la seule initiative de l’Administrateur en dehors du Site
      et/ou du cadre des présentes. Pour ces derniers traitements, l’Administrateur reconnaît et accepte expressément qu’il sera
      responsable unique du traitement et, à ce titre, seul responsable du respect de l’ensemble de la réglementation applicable
      à la protection des données à caractère personnel, et notamment le RGPD.<br>

    </p>
</div>
<?php
include('dossierIncludes\footer.php')
?>  
</body>
</html>