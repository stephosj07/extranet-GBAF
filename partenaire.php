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

	<?php

	//Affichage d'un acteur selon celui demandé via lien lire la suite (page précédente)
	if (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 1))
	{
		$req = $bdd->query('SELECT * FROM acteur WHERE id_acteur=1');
		$resultat = $req->fetch();
		$req->closeCursor();
	}
	elseif (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 2))
	{
		$req = $bdd->query('SELECT * FROM acteur WHERE id_acteur=2');
		$resultat = $req->fetch();
		$req->closeCursor();
	}
	elseif (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 3))
	{
		$req = $bdd->query('SELECT * FROM acteur WHERE id_acteur=3');
		$resultat = $req->fetch();
		$req->closeCursor();
	}
	elseif (isset($_GET['id_acteur']) && ($_GET['id_acteur'] == 4))
	{
		$req = $bdd->query('SELECT * FROM acteur WHERE id_acteur=4');
		$resultat = $req->fetch();
		$req->closeCursor();
	}	 

	/* Recupération et affichage des commentaires avec décompte
	$req = $bdd->query('SELECT * FROM post ORDER BY date_add DESC');
	while ($value = $req->fetch())
	{ */
	?>

	<section class="details-partenaires">
		<div class="details-partenaires__logo"><img src="images/<?php echo $resultat['logo']; ?>" alt="logo partenaire" id="logo-acteur"></div>
		<h2><?php echo $resultat['acteur']; ?></h2>
		<div class="details-partenaires__text">
			<?php echo $resultat['description']; ?>
		</div>
	</section>

	<section class="commentaires-partenaires">
		<div class="commentaires-partenaires__topline">
			<div class="nb-commentaires">
			Nombre de commentaires
			</div> 
			<div class="buttons">
				<div class="button"><a href="postcomment.php?id_acteur=<?php echo $resultat['id_acteur']?>">Nouveau commentaire</a></div> 
				<div class="button">
					<div class="thumb">
						<img src="images/thumb-up-fill.png" id="thumb-up" />
						<img src="images/thumb-down-empty.png" id="thumb-down"/>
					</div>
				</div>
			</div>
		</div>
		<div class="commentaires-partenaires__comments">
		<?php echo htmlspecialchars($value['prenom']); ?><br />
		<?php echo htmlspecialchars($value['date_add']); ?><br />
		<?php echo htmlspecialchars($value['post']); ?><br />
		</div>
	</section>

	<?php include("footer.php"); ?>

</body>
</html>