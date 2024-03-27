<?php 
// require de la connexion à la base de données
require '../../config/db.php';

$requete = "SELECT idprofil, nomprofil FROM profil";

$resultat = $connexion->query($requete);

while ($row = $resultat->fetch_assoc()) {
    $optionsp[] = $row['idprofil'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Ajouter un utilisateur</title>
<link rel="stylesheet" href="../../public/css/styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-light">
<br>
<!-- formulaire d'ajout d'utilisateur -->
<div class="container">
    <main>
<!-- avec la methode POST, toutes les informatiions reçus seront envoyé à la page 'resultat.php' qui elle fera l'action d'ajout souhaité avec le code php-->
    <form class="row g-6" method="POST" action="resInscription.php">

      <div class="col-md-7 col-lg-8">
          <h4 class="mb-3"><b>Nouvel utilisateur</b></h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="col-sm-6">
              <label for="prenom" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>

            <div class="col-12">
              <label for="id" class="form-label">Identifiant</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="id" name="id" placeholder="prenom.nom" required>
              </div>
            </div>
            <div class="col-sm-6">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="col-sm-6">
              <label for="passwordConfirmed" class="form-label">Comfirmez le mot de passe</label>
              <input type="password" class="form-control" id="passwordConfirmed" name="passwordConfirmed" required>
            </div>

            <div class="col-md-5">
              <label for="idprofil" class="form-label">Profil</label>
              <select class="form-select" id="idprofil" name="idprofil" required>
                <!-- faire un dropdown des 2 options -->
                <?php
                foreach ($optionsp as $optionp) {
                    echo "<option value='$optionp'>$optionp</option>";
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
        		<button type="reset" class="btn btn-primary">Effacer</button>
    			</div>
        		<div class="button">
        		<button type="button" class="btn btn-primary" onclick="quitter()">Quitter</button>
        		</div>
        	</div>
		</form>
</div>
</main>

	<script>
        function quitter() {
            // Rediriger l'utilisateur vers la page précédente
            window.history.back();
        }
    </script>
<?php 
$connexion->close();
?>
</body>

</html>