<?php
session_start();
unset($_SESSION);
session_destroy();//ferme la session de l'utilisateur
header('location:../index.php');//redirige vers la page de connexion 
die;
?>