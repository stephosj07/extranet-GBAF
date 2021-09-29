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

// Vérification de la présence de toutes les variables du formulaire d'inscription si tous les champs sont remplis
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['question']) && isset($_POST['reponse']))
{
	// Vérification de la validité du username choisi si disponible
	$req = $bdd->prepare('SELECT * from account WHERE username = :username');
	$req->execute(['username' => $_POST['username'],]);
	$resultat = $req->fetch();

	if(empty($resultat))
	{
		$req->closeCursor();
		// Hachage du mot de passe
		$password = $_POST['password'];
		$pass_hache = password_hash($password, PASSWORD_DEFAULT);
		// Insertion des données du formulaire d'inscription dans table "account"
		$req = $bdd->prepare('INSERT INTO account (nom, prenom, username, password, question, reponse) VALUES(:nom, :prenom, :username, :password, :question, :reponse)');
		$req->execute([
			'nom'	=> $_POST['nom'],
			'prenom'	=> $_POST['prenom'],
			'username'	=> $_POST['username'],
			'password'	=> $pass_hache,
			'question'	=> $_POST['question'],
			'reponse'	=> $_POST['reponse'],
		]);
		$_SESSION['security']=[
			'user_id' =>	(int) $bdd->lastInsertId(),
		];

		// Redirection vers page membres connectés
		header('Location: acteurs-index.php');
	}
	else
	{
		echo 'Cet identifiant est déjà pris, veuillez en sélectionner un autre';
	}
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

	<section class="signup-form">
		<div class="signup-form__wrapper">
			<h1 class="signup-form__title">Créer un compte</h1>
			<form method="post" action="signup.php" class="signup-form__form">
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
				<input type="submit" value="Créer mon compte" class="signup-form__button" />
				</p>
			</form>
		</div>	
	</section>
	
		<?php include("footer.php"); ?>
</body>
</html>