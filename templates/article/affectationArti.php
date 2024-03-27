<!-- page d'affectation d'un article à un utilisateur -->
<?php
 // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: ../login/Connexion.php");
    exit(); 
  } 
?>
<?php 
// connexion à la base de données
require '../../config/db.php';

// requête sql pour récupérer les utilisateurs
$requeteUser = "SELECT nom, prenom FROM utilisateur";
$resultatUser = $connexion->query($requeteUser);
?>

<?php
// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $article = $_POST["article"];
    $user = $_POST["utilisateur"];

    // Requête SQL pour récupérer l'ID de l'utilisateur en fonction du nom et prénom
    $requeteUserId = "SELECT idUser FROM utilisateur WHERE nom = '$user'";
    $resultatUserId = $connexion->query($requeteUserId);
    $row = $resultatUserId->fetch_assoc();
    $idUser = $row['idUser'];
    
    // Préparation de la requête SQL d'insertion
    $requete = "INSERT INTO affecter (numSerie, idUser) VALUES ('$article', '$idUser')";
    $stmt = $connexion->prepare($requete);
    $stmt->execute();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Affecter du matériel</title>
<link rel="stylesheet" href="../../public/css/styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-light">
<br>
<!-- formulaire d'ajout d'utilisateur -->
<div class="container">
    <main>
<!-- avec la methode POST, toutes les informatiions reçus seront envoyé à la page 'resultat.php' qui elle fera l'action d'ajout souhaité avec le code php-->
    <form class="row g-6" method="POST" action="#">

      <div class="col-md-7 col-lg-8">
          <h4 class="mb-3"><b>Affecter du matériel</b></h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-8">
              <?php 
                            // Vérification si des résultats sont retournés
                            if ($resultatUser->num_rows > 0) {
                                // Affichage de la liste déroulante des utilisateurs
                                echo "<select name='utilisateur'>";
                                echo "<option value''>Utilisateur</option>";
                                while ($row = $resultatUser->fetch_assoc()) {
                                    echo "<option value='" . $row['nom'] . "'>" . $row['nom'] . " " . $row['prenom'] . "</option>";
                                }
                                echo "</select>";
                            } else {
                                echo "Aucun utilisateur trouvé.";
                            }
                            ?>
                        </div><br>
                        
                        
                        <div class="col-sm-8">
                            <select id="article" name="article">
                                <?php
                                // Requête SQL pour récupérer les articles
                                $requeteArticle = "SELECT numSerie, nomType, nomModele, nomCategorie, nomSousCategorie FROM article JOIN modele ON article.idModele=modele.idModele JOIN type ON type.idType=article.idType";
                                $resultatArticle = $connexion->query($requeteArticle);

                                // Afficher les options du sélecteur
                                echo "<option value''>Matériel</option>";
                                while ($row = $resultatArticle->fetch_assoc()) {
                                    echo "<option value='" . $row['numSerie'] . "'>" . $row['numSerie'] . " : " . $row['nomType'] . " - " . $row['nomModele'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

            
    		<!-- les boutons -->
    		<div>
    			<div class="button">
        		<button type="submit" class="btn btn-primary">Ajouter</button>
        		</div>
        		<div class="button">
        		<button type="button" class="btn btn-primary" onclick="quitter()">Quitter</button>
        		</div>
        	</div>
		</form>
</div>
</main>
<?php 
include 'tableAffectation.php';
?>

	<script>
        function quitter() {
            // Rediriger l'utilisateur vers la page d'accueil
            window.location.href = "../../index.php";
        }
    </script>

</body>

</html>
