<header>
	<div class="user-header">
		<img src="images/logo_gbaf.png" alt="logo GBAF" id="user-header__logo" />
	</div>
	<div class="user-icon">
		<div class="user-icon__username">
			<?php echo htmlspecialchars($_SESSION['prenom']); ?>
			<?php echo htmlspecialchars($_SESSION['nom']); ?>
		</div>
		<div class="user-icon__menu">
		<nav>
			<img src="images/settings-icon.png" alt="Compte utilisateur" id="settings-icon" />
			<ul class="dropdown">
				<li><a href="user-settings.php">Paramètres du compte</a></li>
				<li><a href="signout.php">Se déconnecter</a></li>
			</ul>
		</nav>
		</div>
	</div>

</header>

