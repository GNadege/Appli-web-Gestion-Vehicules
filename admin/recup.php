<?php
if( isset( $_POST['idvehicule'] ) )//Récupération de l'id du vehicule
 $idvehicule = (int)$_POST['idvehicule'];
 else
$idvehicule =null;

if( isset( $_POST['idadmin'] ) )//Récuperation de l'id de l'utilisateur
 $idadmin = (int)$_POST['idadmin'];
 else
$idadmin =null;

if( isset( $_POST['date_emprunt'] ) )//Récupération de la date d'emprunt
 {$date_emprunt = $_POST['date_emprunt'];
 $date_empruntf = $_POST['date_emprunt'];}
 else
$date_emprunt =null;

if( isset( $_POST['date_retour'] ) )//Récupération de la date de fin d'emprunt
 {$date_retour = $_POST['date_retour'];
 $date_retourf = $_POST['date_retour'];}
 
 else
$date_retour=null;

if( isset( $_POST['commentaire'] ) )//Récupération du commentaire
 $commentaire = htmlentities($_POST['commentaire']);
 else
$commentaire=null;

include("../admin/connexion.php");//Récupération de la session

$sql = "SELECT idvehicule, date_emprunt, date_retour
    FROM dispo
    WHERE idvehicule=$idvehicule";//requette sql
    $resultat = mysqli_query($bdd, $sql);//Association entre la requette et la variable de connexion

$error=0;//initialisation d'une variable

while($donnees = mysqli_fetch_assoc($resultat))//chargement des données issues de la requete sql et ajout dans une boucle
  {
    $date_emprunt2=$donnees['date_emprunt'];//date_emprunt2 = donnée de la base de donnée
    $date_retour2=$donnees['date_retour'];

  if ($date_emprunt2<=$date_emprunt && $date_emprunt<=$date_retour2 || $date_emprunt2<=$date_retour && $date_retour<=$date_retour2)//Condition pour afficher une erreur
  { 
    echo '<h1 class="erreur">Erreur, confilt avec une autre reservation.</h1>';//Affichage du message d'erreur
    $error=1;//Initialisation de la variable à 1 pour ne pas utiliser la prochaine condition
  }
}

$date_emprunt = new DateTime($date_emprunt);//création d'un format de date
$date_retour = new DateTime($date_retour);
$nbjour= $date_emprunt->diff($date_retour)->format("%r%d");//Calcul de la difference entre les dates...
if ($error==0){
  if ($nbjour>=0)//...si le resultat du calcul est positif :
    {
      $date_emprunt = $date_empruntf;//création d'un format de date
      $date_retour = $date_retourf;
      
      $sql = "INSERT INTO dispo
      SET date_emprunt='$date_emprunt', date_retour='$date_retour', idvehicule = '$idvehicule', idadmin=$idadmin, commentaire='$commentaire'"  ;
    $result = mysqli_query($bdd, $sql);//requette sql pour ajouter la reservation à la base de donnée
    echo '<h1> RESERVATION PRISE EN COMPTE</h1>';//Affichage de la confirmation de reservation
    // echo $sql;
    }
    else{//Si le resultat du calcul est négatif:
      echo'<h1 class="erreur">Erreur, réservation non prise en compte</h1>';
    }

  }


?>

<html>
  <head>
    <meta http-equiv="refresh" content="5; URL=modif.php"> 
    <title>Récupération...</title>
    <link href="../css/style-admin.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../images/bar-admin.svg">
  </head>
  <body>
    <?php
    echo 'Date emprunt :'.$date_empruntf.'
    <br />Date de retour: <mark >'.$date_retourf.'</mark>
    <br />Id vehicule : ' .$idvehicule ;// Affichage des dates de réservation pour confirmation
    ?>
    <br />Redirection...
  </body>
</html>
