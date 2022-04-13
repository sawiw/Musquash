<?php
session_start();
header('Location: /adhesions.php?validationForm="ok"&adhesion='.$_GET['adhesion'].'&duree='.$_GET['duree']);