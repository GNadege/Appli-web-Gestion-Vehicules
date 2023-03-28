<?php
define("HOTE",  "localhost");// connexion à la base de donnée
define("BASE",  "bdd_sn");
define("USER",  "root");
define("PASS",  "");
define("SALT",  "pepper");

if($bdd = mysqli_connect(HOTE, USER, PASS, BASE))
{
    mysqli_set_charset($bdd, 'utf8');// Si la connexion a réussi, rien ne se passe.
}
else // Mais si elle rate...
{
    echo 'Erreur'; // On affiche un message d'erreur.
}
