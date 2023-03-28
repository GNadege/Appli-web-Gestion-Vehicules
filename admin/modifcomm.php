<?php
include('session.php');//récuperation de la session
$user=$_SESSION['user'];
$idadmin=$_SESSION['idadmin'];
include('../admin/connexion.php');
$id = $_GET['iddispo']??1;

$sql = "SELECT commentaire, iddispo
FROM dispo
WHERE iddispo=$id";//récupération de la table

$result = mysqli_query($bdd, $sql);//Association entre la requette et la variable de connexion

while($donnees = mysqli_fetch_assoc($result))//création d'un resultat sous forme de tableau associatif
  {
$commentaire=$donnees['commentaire'];
$iddispo=$donnees['iddispo'];
//echo $commentaire;
  }
?>

<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/style-admin.css" rel="stylesheet">
<title>Modification de votre commentaire</title>
</head>
<body>
  <h2><a href="modif.php">Retour</a> </h2> <!--Bouton retour-->
 <form id="form1" name="form1" method="post" action="updatecommentaire.php"><!--Formulaire de reservation-->
  <p>
    <label for="valeur">nouveau commentaire :</label>
    <textarea name="commentaire" maxlength="200"><?php echo $commentaire; ?></textarea>
  </p>
  <input type="hidden" name="iddispo" value="<?php echo $iddispo; ?>" />
  <input type="submit" name="button" id="button" value="Envoyer" /></p><!--Bouton de validation-->
</form>


</body>
</html>