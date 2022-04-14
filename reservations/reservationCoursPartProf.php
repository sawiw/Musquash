<?php
session_start();
require_once('../fonctions/fonctionPreReservProf.php');
echo preReservation($_SESSION['id'], $_POST['idTerrainRes'], $_POST['horaire']);