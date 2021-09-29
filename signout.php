<?php
$_SESSION = array();
session_destroy();

// Redirection vers page d'accueil index.php
header('Location: index.php');
?>