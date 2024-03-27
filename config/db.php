<!-- connexion à la base de données -->
<?php
$connexion = new mysqli("localhost", "root", "", "gestionstock");

if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}
?>