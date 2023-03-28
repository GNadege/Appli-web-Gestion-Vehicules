<?php
include('session.php');//récuperation de la session
$user=$_SESSION['user'];
$idadmin=$_SESSION['idadmin'];
include('../admin/connexion.php');
$id = $_GET['id']??1;
$oy=date("Y-m-d");//récuperation de la date du jour
?>

<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style-admin.css" rel="stylesheet">
<title>Réservation</title>
</head>
<body>
  <h2><a href="modif.php">Retour</a> </h2> <!--Bouton retour-->
 <form id="form1" name="form1" method="post" action="recup.php"><!--Formulaire de reservation-->
  <p>
    <label for="valeur">Date début d'emprunt</label>
    <input type="date" value min =<?php echo $oy; ?>  name="date_emprunt"/>
  </p>
  <p>
    <label for="valeur">Date de fin d'emprunt</label>
    <input type="date" value min =<?php echo $oy; ?>  name="date_retour" />
  </p>
  <p>
    <label for="valeur">commentaire (optionnel) :</label>
    <textarea name="commentaire" maxlength="200"></textarea>
  </p>
  <input type="hidden" name="idadmin" value="<?php echo $idadmin; ?>" readonly/><!--Valeurs récupérées en arrière plan-->
  <input type="hidden" name="idvehicule" value="<?php echo $id; ?>">
  <input type="hidden" name="date_reservation" value="<?php echo $oy; ?>">
  <input type="submit" name="button" id="button" value="Envoyer" /></p><!--Bouton de validation-->
</form>

<?php 
$sql = "SELECT date_emprunt, date_retour, date_reservation, commentaire, idadmin, iddispo
FROM dispo
WHERE idvehicule=$id AND date_retour>now()";//récupération de la table

$result = mysqli_query($bdd, $sql);//Association entre la requette et la variable de connexion

while($donnees = mysqli_fetch_assoc($result))//création d'un resultat sous forme de tableau associatif
  {
$date_emprunt=$donnees['date_emprunt'];
$date_retour=$donnees['date_retour'];
$commentaire=$donnees['commentaire'];
$idadminbdd=$donnees['idadmin'];
$iddispo=$donnees['iddispo'];

if ($date_emprunt<$oy && $date_retour>$oy){
  echo '<h1 class="erreur">En utilisation</h1>';//permet d'indiquer si le véhicule est en utilisation
}
echo '<div>';
if ($idadminbdd==$idadmin){// Si la personne connectée a fait des commentaires...
echo  '<p> vous avez commenté : <strong>'.$commentaire.''; //affiche les commentaires
echo '<a href="modifcomm.php?iddispo='.$iddispo.'"/></br>Modifier votre commentaire</a>'; //...Elle peut les supprimer
}
echo'</p>';

$date_emprunt = new DateTime($date_emprunt);//création d'un format de date
$date_retour = new DateTime($date_retour);

if ($date_retour>$oy){//Permet de bloquer les possibles réservation antérieures à la date du jour
echo  '<p> Emprunté du : <strong>'.$date_emprunt->format('d-m-Y').'</strong> au <strong>'.$date_retour->format('d-m-Y').'</strong>'; //affiche les réservations en cours avec le bon format de date

if ($idadminbdd==$idadmin){// Si la personne connectée a fait des reservations...
  echo '<a href="supresa.php?iddispo='.$iddispo.'"/> Supprimer votre reservation</a>'; //...Elle peut les supprimer
}
echo'</p>';
  }
  echo '</div>'."\n";
}
?>
</body>
</html>





