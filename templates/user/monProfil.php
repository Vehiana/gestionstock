<?php 
require '../../config/db.php';

session_start();

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$username = $_SESSION['login'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement du formulaire de modification
    // Récupérer les données soumises par l'utilisateur
    $nouveau_nom = $_POST['nom'];
    $nouveau_prenom = $_POST['prenom'];
    $nouveau_username = $_POST['login'];


    // Enregistrer les modifications dans la base de données (à implémenter)
    $requete = "INSERT INTO utilisateur (nom, prenom, login) VALUES (?, ?, ?)";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("sss", $nouveau_nom, $nouveau_prenom, $nouveau_username);
    $stmt->execute();


    // Afficher un message de succès après la modification
    $message = "Vos informations ont été mises à jour avec succès.";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Mon Profil</title>
<link rel="stylesheet" href="public/css/styles.css" >
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body> 

<!-- affichage du profil de l'utilisateur connecté -->
<main class="container">
    <h1>Mon Profil</h1>
    <?php if(isset($message)): ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>"><br><br>
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>"><br><br>

        <label for="login">Username :</label>
        <input type="text" id="login" name="login" value="<?php echo $username; ?>"><br><br>

        <input type="submit" value="Enregistrer les modifications">
        <button type="button" onclick="retourPagePrecedente()">Quitter</button>
    </form>
</main>



<!-- les scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script>
          function quitter() {
                // Rediriger l'utilisateur vers la page d'accueil
                window.location.href = "../../index.php";
            }
    </script>
    <script>
        function retourPagePrecedente() {
            history.back();
        }
    </script>
</body>  
</html>
