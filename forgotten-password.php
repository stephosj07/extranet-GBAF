<?php
session_start();
// Connexion à la base de données 
try
{
$bdd = new PDO('mysql:host=localhost;dbname=extranet_gbaf;charset=utf8', 'root', 'root', [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
}
catch (Exception $e)
{
		die('Erreur : ' . $e->getMessage());
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

	<section class="user-settings">
		<div class="user-settings__wrapper">
			<h1 class="user-settings__title">Mot de pass oublié ?</h1>
			<form method="post" action="user-settings.php" class="user-settings__form">
				<p>
				<label for="lastname">Nom</label>
				<input type="text" name="nom" id="nom" size="48" maxlength="40" required /><br />
				<label for="firstname">Prénom</label>
				<input type="text" name="prenom" id="prenom" size="48" maxlength="40" required /><br />
				<label for="username">Identifiant</label>
				<input type="text" name="username" id="username" size="48" maxlength="40" required /><br />
				<label for="password">Mot de passe</label>
				<input type="password" name="password" id="password" size="48" maxlength="40" required /><br />
				<label for= "secretquestion">Question secrète</label>
				<input type="text" name="question" id="question" size="48" max length="255" required /><br />
				<label for="secretanswer">Réponse à la question secrète</label>
				<input type="text" name="reponse" id="reponse" size="48" maxlength="255" required /><br />
				<input type="submit" value="Confirmer nouveau mot de passe" class="user-settings__button" />
				</p>
			</form>
		</div>	
	</section>

    <?php include("footer.php"); ?>

</body>
</html>