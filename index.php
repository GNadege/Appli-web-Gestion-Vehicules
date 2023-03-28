<?php
	include('./admin/connexion.php'); //connexion à la base de donnée
	$tok= random_bytes(12);//création de token
	$tokcookie=md5(date("Y-m-d").$tok);//Integration du token dans le cookie de session
	$cook='cook'.date("d");

	if(isset($_POST['login'])&&(isset($_POST['pass']))
	&&($_POST['token']==$_COOKIE[$cook]))
	{
		sleep(1);// contre les brutes force
	   $login = htmlentities($_POST['login']);//login du formulaire
	   $pwd = $_POST['pass'];
	   $pwd = sha1($pwd.SALT); // décodage + Sallage
    
    $sql = "SELECT  login, pwd, niveau, idadmin, nom, prenom FROM admin 
		WHERE login='$login' AND pwd='$pwd' "; //requette sql et comparaison
    $resultat = mysqli_query($bdd, $sql);
	$count=mysqli_num_rows($resultat);//le nombre de resultats doit être = 1
	$donnees=mysqli_fetch_row($resultat);
    // On charge les données issues de la requête
		if ($donnees>0){
			$logindb=$donnees[0];//login de la base de données
		    $pwddb=$donnees[1];//mot de passe de la base
			$nxdb=$donnees[2];
			$idadmin=$donnees[3];
			$nom=$donnees[4];
			$prenom=$donnees[5];
			}
			if ($login===$logindb AND $pwd===$pwddb)
			{
			  session_start(); //démarrage d'une session
			  $_SESSION['nx']=$nxdb ;
			  $_SESSION['user']=$logindb;
			  $_SESSION['idadmin']=$idadmin;
			  $_SESSION['nom']=$nom;
			  $_SESSION['prenom']=$prenom;
				header('Location: admin/modif.php');//puis redirection
			}
				else {
				header('Location: index.php?error=error');//en cas d'erreur, pas de redirection
				}
		}
		setcookie($cook,$tokcookie); // cookie de session
	?>

<html>
<head>
  <meta name="author" content="Nadège Grandyot" />
  <meta charset="utf-8">
	<link href="./css/style-admin.css" rel="stylesheet"><!-- importation du css-->
	<link rel="icon" type="image/svg+xml" href="./images/bar-admin.svg">
  <title>Connexion a votre espace</title>
</head>
<body>
<header>
	<div>
	<h1>Réservation des véhicules</h1>
</div>

</header>
<article>

<h3>Authentification :</h3>
<?php
$erreur=$_GET['error']??NULL;//en cas d'erreur...
if ($erreur!=NULL){echo '<h2> Identifiant ou mot de passe faux </h2>';}//...afficher 
 ?>
 <form name="form1" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"><!-- formulaire de connexion-->
 <p><label for="login">Login</label>
 <input type="text" name="login" /></p>
 <p><label for="pass">Mot de Passe</label>
 <input type="password" name="pass" /></p>

 <input type="submit" name="Submit" value="Ok" />
 <input type="hidden" name="token" value="<?php echo md5(date("Y-m-d").$tok); ?>" />
 </form>

</article>

</body>
</html>
