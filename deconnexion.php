<?php   
session_start(); //S'assurer de la bonne session
session_destroy(); //La destroncher
header("Location: /musquash/index.php"); //Back to l'index
?>