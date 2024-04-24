<?php
// Connexion à la base de données
require '../../config/db.php';

$message = '';

// Vérification du login/password
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Récupération du sel de l'utilisateur
    $salt = recupSel($username);
    
    // Vérification si l'utilisateur existe dans la base de données
    if ($salt !== false) {
        // Vérification de l'authenticité du mot de passe avec password_verify()
        if (verifAuthentification($username, $password, $salt)) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: ../../index.php');
            exit(); // Arrêt du script après la redirection
        } else {
            $message = 'Identifiants invalides.';
        }
    } else {
        $message = 'Utilisateur non trouvé.';
    }
}

 
// Fonction qui récupère le sel de l'utilisateur dans la base de données
function recupSel($username) {   
    global $connexion; 
    
    $requete = $connexion->prepare("SELECT selUser FROM utilisateur WHERE login = '$username'");
    $requete->execute();
    $result = $requete->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['selUser'];
    } else {
        return false;
    }
}

// Fonction de vérification d'authentification
function verifAuthentification($username, $password, $salt) {
    global $connexion;
    
    $requete = $connexion->prepare("SELECT hashed_password FROM utilisateur WHERE login = '$username'");
    $requete->execute();
    $result = $requete->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $passwordHash = $row['hashed_password'];
        // Vérification du mot de passe avec le sel
        return password_verify($password . $salt, $passwordHash);
    } else {
        return false;
    }
}
?>

<!-- Votre formulaire HTML ici avec l'affichage du message d'erreur -->
<!DOCTYPE html>
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Vérification</title>
 <!-- importer le fichier de style -->
 <link rel="stylesheet" href="../../public/css/styles.css" type="text/css" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 </head>
 <body style='background:#fff;'>
 <div id="content">
 <!-- tester si l'utilisateur est connecté -->
<div class="container">
<div>
<br>
<br>
<p>Vos identifiants sont incorrectes. Veuillez réessayer !</p>
</div>
<div class="button">

	<button type="button" class="btn btn-primary" onclick="connexion()">Se connecter</button>
</div>

</div>
 
 </div>
 </body>
 <script>
 	function connexion() {
 		window.location.href="Connexion.php";
 		}
 </script>
