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

// Récupération et affichage du nom et prénom du membre connecté
if (isset($_SESSION['id_user']) && isset($_SESSION['username']))
{
	$req = $bdd->query('SELECT * FROM account WHERE id_user='.$_SESSION['id_user']);
	$resultat = $req->fetch();
	$_SESSION['prenom']=$resultat['prenom'];
	$_SESSION['nom']=$resultat['nom'];
	$req->closeCursor();
}

// Récupération et affichage du nom et prénom du dernier inscrit
elseif (isset ($_SESSION['security']['user_id']))
{
	$req = $bdd->query('SELECT * FROM account WHERE id_user='.$_SESSION['security']['user_id']);
	$resultat = $req->fetch();
	$_SESSION['prenom']=$resultat['prenom'];
	$_SESSION['nom']=$resultat['nom'];
	$req->closeCursor();
}

// Récupération et affichage de la première ligne de description du partenaire



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

	<section class="presentation">
		<div class="presentation__wrapper">
			<h1 class="presentation__title">Le GBAF lance son Extranet</h1>
			<div class="presentation__text">
				Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :
			
				<ul>
					<li>BNP Paribas</li>
					<li>BPCE</li>
					<li>Crédit Agricole</li>
					<li>Crédit Mutuel-CIC</li>
					<li>Société Générale</li>
					<li>La Banque Postale</li>
				</ul>
				Le GBAF a pour mission de promouvoir l'activité bancaire à l'échelle nationale.<br />
				Les produits et services bancaires étant très nombreux et variés, les salariés des 340 agences des banques et assurances en France passaient beaucoup de temps à faire des recherches sur Internet, afin de renseigner au mieux leurs clients. Il n'existait aucune base de données pour chercher ces informations de manière fiable et rapide, ou pour donner son avis sur les partenaires et acteurs du secteur bancaire, tels que les associations ou les financeurs solidaires.<br />
				<div class="presentation__text__part2">
				Pour remédier à cela, le GBAF a créé un extranet donnant accès à ces informations cruciales. Il s'agit d'un point d'entrée unique répertoriant un grand nombre d'informations sur les partenaires et acteurs du groupe, ainsi que sur les produits et services bancaires et financiers. En tant que salariés d'un grand groupe français, vous pouvez ainsi vous entraider en postant des commentaires et en donnant vos avis sur chaque acteur.
				</div>
			</div>
		</div>
		<div class="presentation__illustration">
			<img src="images/logo_gbaf.png" alt="logo GBAF" id="presentation__logo" />
			<p> | Extranet</p>
		</div>
	</section>

	<section class="acteurs">
		<div class="acteurs__wrapper">
			<h1 class="acteurs__title">Les différents acteurs/partenaires du système bancaire français</h1>
			<article class="acteurs-list">
				<ul class="acteurs-list__list">
					<li class="acteur">
						<div class="acteur__logo>"><img src="images/formationco.png" alt="logo Formation&co" id="logo-formationco-min"></div>
						<div class="acteur__description">
							<h3 class="acteur__description__title">Formation & co</h3>
							<div class="acteur__description__wrapper">
								<div class="acteur__description__wrapper__text">Formation&co est une association française...</div>
								<div class="acteur__description__wrapper__link"><a href="partenaire.php?id_acteur=1">Lire la suite</a></div>
							</div>
						</div>
					</li>
					<li class="acteur">
						<div class="acteur__logo>"><img src="images/protectpeople.png" alt="logo Protectpeople" id="logo-protectpeople-min"></div>
						<div class="acteur__description">
							<h3 class="acteur__description__title">Protectpeople</h3>
							<div class="acteur__description__wrapper">
								<div class="acteur__description__wrapper__text">Protectpeople finance la solidarité nationale...</div>
								<div class="acteur__description__wrapper__link"><a href="partenaire.php?id_acteur=2">Lire la suite</a></div>
							</div>
						</div>
					</li>
					<li class="acteur">
						<div class="acteur__logo>"><img src="images/dsafrance.png" alt="logo DSA France" id="logo-dsafrance-min"></div>
						<div class="acteur__description">
							<h3 class="acteur__description__title">DSA France</h3>
							<div class="acteur__description__wrapper">
								<div class="acteur__description__wrapper__text">Dsa France accélère la croissance...</div>
								<div class="acteur__description__wrapper__link"><a href="partenaire.php?id_acteur=3">Lire la suite</a></div>
							</div>
						</div>
					</li>
					<li class="acteur">
						<div class="acteur__logo>"><img src="images/cde.png" alt="logo CDE" id="logo-cde-min"></div>
						<div class="acteur__description">
							<h3 class="acteur__description__title">CDE</h3>
							<div class="acteur__description__wrapper">
								<div class="acteur__description__wrapper__text">La CDE (Chambre Des Entrepreneurs)...</div>
								<div class="acteur__description__wrapper__link"><a href="partenaire.php?id_acteur=4">Lire la suite</a></div>
							</div>
						</div>
					</li>
				</ul>
			</article>
		</div>
	</section>

	<?php include("footer.php"); ?>

</body>
</html>