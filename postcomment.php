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

	<?php include("user-header.php"); ?>

    <section class="postcomment-form">
		<div class="postcomment-form__wrapper">
			<h1 class="postcomment-form__title">Nouveau commentaire</h1>
			<form method="post" action="postcomment.php" class="postcomment-form__form">
				<p>
				<textarea name="post" rows="8" cols="45">Ecrivez votre commentaire ici.</textarea>
				<input type="submit" value="Poster mon commentaire" class="postcomment-form__button" />
				</p>
			</form>
		</div>	
	</section>

	<?php

	$date_add = date("d/m/Y",time());

	if (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 1) && isset($_POST['post']) && isset($_SESSION['id_user']))
	{
		$req = $bdd->prepare('INSERT INTO post (id_user, id_acteur, date_add, post) VALUES(:id_post, :id_user, 1, NOW(), :post)');
		$req->execute([
			'id_user' => $_SESSION['id_user'],
			'id_acteur' => $_GET['id_acteur'],
			'date_add' => $date_add,
			'post' => $_POST['post'],
		]);

		// Redirection vers page acteur correspondant
		header('Location: partenaire.php?id_acteur=1');
	}
	elseif (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 2) && isset($_POST['post']))
	{
		$req = $bdd->prepare('INSERT INTO post (id_user, id_acteur, date_add, post) VALUES(:id_user, 2, NOW(), :post)');
		$req->execute([
			'id_user' => $_SESSION['id_user'],
			'id_acteur' => $_GET['id_acteur'],
			'date_add' => NOW(),
			'post' => $_POST['post'],
		]);

		// Redirection vers page acteur correspondant
		header('Location: partenaire.php?id_acteur=2');
	}
	elseif (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 3 ) && isset($_POST['post']))
	{
		$req = $bdd->prepare('INSERT INTO post (id_user, id_acteur, date_add, post) VALUES(:id_user, 3, NOW(), :post)');
		$req->execute([
			'id_user' => $_SESSION['id_user'],
			'id_acteur' => $_GET['id_acteur'],
			'date_add' => NOW(),
			'post' => $_POST['post'],
		]);

		// Redirection vers page acteur correspondant
		header('Location: partenaire.php?id_acteur=3');
	}
	elseif (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 4 ) && isset($_POST['post']))
	{
		$req = $bdd->prepare('INSERT INTO post (id_user, id_acteur, date_add, post) VALUES(:id_user, 4, NOW(), :post)');
		$req->execute([
			'id_user' => $_SESSION['id_user'],
			'id_acteur' => $_GET['id_acteur'],
			'date_add' => NOW(),
			'post' => $_POST['post'],
		]);

		// Redirection vers page acteur correspondant
		header('Location: partenaire.php?id_acteur=4');
	}

	?>

    <?php include("footer.php"); ?>

</body>
</html>