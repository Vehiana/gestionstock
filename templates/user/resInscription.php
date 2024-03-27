<?php
require '../../config/db.php';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire (5)
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $username = $_POST["id"];
    $password = $_POST["password"];
    $passwordConf = $_POST["passwordConfirmed"];
    $idProfil = $_POST["idprofil"];
}

// les conditions pour confirmer l'ajout (la validité du mot de passe)
if ($password != $passwordConf || strlen($password) < 8 ||
    (!preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password) ||
        !preg_match("#[0-9]+#", $password) || !preg_match("#\W+#", $password)) ||
    $password != $passwordConf)
            {
                echo "<div class='container'><p>Le mot de passe est invalide.</p><button type='button' class='btn btn-primary' onclick='retry()'>Retour</button></div>";
// seulement après avoir validé le mdp, ajouter l'utilisateur
} else {
    adduser($nom, $prenom, $username, $password, $idProfil);
    echo "<div class='container'><p>Bienvenue $nom $prenom.</p><button type='button' class='btn btn-primary' onclick='accueil()'>Accueil</button><button type='button' class='btn btn-primary' onclick='retry()'>Retour</button></div>";
}




// fonction pour ajouter un nouvel utilisateur
function adduser($nom, $prenom, $username, $password, $idProfil) {
    global $connexion;
    
    // générer le sel de l'utilisateur
    $salt = bin2hex(openssl_random_pseudo_bytes(16));
    
    // générer le mdp haché de l'utilisateur
    $hashed_password = password_hash($password . $salt, PASSWORD_BCRYPT);
    
    // requête préparéepour l'ajout de l'utilisateur
    $sql = "INSERT INTO utilisateur (nom, prenom, login, idprofil, hashed_password, selUser) VALUES ('$nom', '$prenom', '$username', '$idProfil', '$hashed_password', '$salt');";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    // fermeture de la requête préparée
    $stmt->close();

}

// fermeture de la connexion
$connexion->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Vérification</title>
<link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
</body>
<script>
    function retry() {
        window.history.back();
    }

    function accueil() {
        window.location.href = "../../index.php";
    }
</script>
</html>
