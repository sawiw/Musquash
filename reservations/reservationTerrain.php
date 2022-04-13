<?php
session_start();
require_once('../fonctions/fonctionReservationTerrain.php');
echo reservationTerrain($_SESSION['id'], $_POST['idTerrainRes'], $_POST['horaire']);