<?php
session_start();
require_once('../fonctions/fonctionReservationCoursColl.php');

echo reservationCoursColl($_SESSION['id'], $_POST['idCours']);