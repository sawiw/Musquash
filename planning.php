<?php
session_start();
// require('./sql/bddConnexion.php');
require('fonctions\fonctionPlanning.php');
echo planning(1,18,2022);
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning</title>
</head>
<body>
    <h1>PLANNING</h1>
    <br>
    <table>
        <thead>
            <tr>
                <th colspa></th>
            </tr>
        </thead>
    </table>
</body>
</html> -->