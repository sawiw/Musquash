<?php
session_start();
require_once('../fonctions/fonctionCoursInd.php');
echo reservationCoursInd($_SESSION['id'], $_POST['idTerrainRes'], $_POST['horaire']);