<?php
if( isset( $_GET['iddispo'] ) )
 $iddispo = (int)$_GET['iddispo'];
 else
$iddispo =null;//Récupération de l'id de la reservation

include("../admin/connexion.php");

$sql = "DELETE FROM dispo
WHERE iddispo = $iddispo";//Requette sql
  $resultat = mysqli_query($bdd, $sql);//Association entre la requette et la variable de connexion
?>

<html>
<head>
   <meta http-equiv="refresh" content="5; URL=modif.php"><!--Affichage de la page durant 5secondes puis redirection-->
    <title>Suppression..</title>
    <link href="../css/style-admin.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../images/bar-admin.svg">
  </head>
  <body>
    <h1>Réservation supprimée</h1>
    <br />Redirection...
  </body>
</html>
