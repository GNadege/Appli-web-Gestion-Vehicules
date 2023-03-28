<?php

  session_start();
  if (isset($_SESSION['nx']) && ($_SESSION['nx']==1)) {
    echo "Bienvenue ";
    echo $_SESSION['prenom'];
    echo "  ";
    echo $_SESSION['nom'];
  }
else {
// sinon on le redirige vers la page d'accueil
  header('Location:../index.php');
;
}
?>
