<?php
session_start();

// Connexion à la base de données 
try
{
$bdd = new PDO('mysql:host=localhost;dbname=extranet_gbaf;charset=utf8', 'root', 'root', [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// Vérification de la présence de toutes les variables du formulaire de connexion, si les 2 champs sont remplis
if(isset($_POST['username']) && isset($_POST['password']))
{
	// Vérification des infos saisis, si username et password correspondent à un membre existant dans la bdd
	$req = $bdd->prepare('SELECT * FROM account WHERE username = :username');
	$req->execute(['username' => $_POST['username'],]);
	$resultat = $req->fetch();

	if (!$resultat)
	{
		echo 'Mauvais identifiant ou mot de passe !';
	
	}

	else
	{
		// Comparaison du password envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
		if ($isPasswordCorrect) {
			session_start();
			$_SESSION['id_user'] = $resultat['id_user'];
			$_SESSION['username'] = $_POST['username'];
			echo 'Vous êtes connecté !';

			// Redirection vers page membres connectés
				header('Location: acteurs-index.php');
		}
		else {
			echo 'Mauvais identifiant ou mot de passe !';
		}
		
	}	
	$req->closeCursor();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>GBAF | Extranet</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
	<link rel="apple-touch-icon" type="image/png" href="images/favicon.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	
	<?php include("welcome-header.php"); ?>

	<section class="connect-form">
		<div class="connect-form__wrapper">
			<h1 class="connect-form__title">Se connecter</h1>
			<form method="post" action="index.php" class="connect-form__form">
				<p>
				<label for="username">Identifiant</label><br />
				<input type="text" name="username" id="username" size="40" maxlength="40" required /><br />
				<label for="password">Mot de passe</label><br />
				<input type="password" name="password" id="password" size="40" maxlength="40" required /><br />
				<div class="connect-form__forgotten-password">
					<a href="forgotten-password.php">Mot de passe oublié ?</a>
				</div>
				<input type="submit" value="Se connecter"  id="connect-button"/><br />
				<div class="create-account-button">
				<a href="signup.php">Créer un compte</a>
				</div>
				</p>
			</form>
		</div>
	</section>

	<?php include("footer.php"); ?>
	

	
</body>
</html>