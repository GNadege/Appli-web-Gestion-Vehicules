<?php
require_once("session.php");//recuperation de la session
include("../admin/connexion.php");

$sql = "SELECT idvehicule, modele, carburant, plaque, statut, Anneecontrole, Description, emplacement,intitule
        FROM  vehicules 
        inner join type_vehicule on type_vehicule.idtype = vehicules.idvehicule
        ORDER BY statut"; //requette sql pour récupetaion de la table
$resultat = mysqli_query($bdd, $sql);//Association entre la requette et la variable de connexion

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
		<meta charset="UTF-8" />
    <title>Liste des vehicules</title>
    <link href="../css/style-admin.css" rel="stylesheet">
    <style rel="stylesheet">
      .liste{
        font-family:courier;
      }
      h4{
        text-align: right;
        padding-right: 10vw;
      }
    </style>
	</head>
<body>
  <h1>Liste des resultats</h1>
  <h4><a href="Logout.php">Deconnexion</a> </h4>
  <section>

  <?php
  while($donnees = mysqli_fetch_assoc($resultat))// création d'un resultat sous forme de tableau associatif
  {
    $idvehicule=$donnees['idvehicule']; 
    $modele=$donnees['modele'];
    $plaque=$donnees['plaque'];
    $intitule=$donnees['intitule'];
    $statut=$donnees['statut'];
    $Anneecontrole=$donnees['Anneecontrole'];
    $emplacement=$donnees['emplacement'];

    echo  '<p class="liste" data-statut="'.$statut.'">ID du vehicule : '.$idvehicule.' | <strong>'.$modele.'</strong> | '.$plaque.' | '.$intitule.' | Emplacement : '.$emplacement.'
    <a class="lien" href="detail-modif.php?id='.$idvehicule.'"> <strong>Reserver </strong></a></p>'."\n";//affichage des vehicules avec bouton de modification
  }  
  ?>
  </section>
</body>
</html>
