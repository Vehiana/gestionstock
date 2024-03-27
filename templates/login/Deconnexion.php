<?php
// Initialiser la session
session_start();

// Détruire la session.
$_SESSION['username'] = false;
session_destroy();

// Empêcher la mise en cache de la page par le navigateur
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirection vers la page de connexion
header("Location: Connexion.php");
exit();
?>

