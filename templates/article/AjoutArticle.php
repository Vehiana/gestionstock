<!-- page d'ajout d'articles -->
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

// requêtes sql (select)
$requetetype = "SELECT idType, nomType FROM Type";
$requetemodele = "SELECT idModele, nomModele FROM Modele";
$requetesouscat = "SELECT DISTINCT(nomSousCategorie) FROM souscategorie";
$requetefourn = "SELECT idFournisseur, nomFournisseur FROM Fournisseur";
$requetecat = "SELECT nomCategorie FROM Categorie";

// resultats des requêtes
$resultat1 = $connexion->query($requetetype);
$resultat2 = $connexion->query($requetemodele);
$resultat3 = $connexion->query($requetesouscat);
$resultat4 = $connexion->query($requetefourn);
$resultat5 = $connexion->query($requetecat);

// ajouter dans les array() les valeurs des requêtes pour l'affichage
while ($row = $resultat1->fetch_assoc()) {
    $optionst[] = $row['idType']. " : " .$row['nomType'];
}
while ($row = $resultat2->fetch_assoc()) {
    $optionsm[] = $row['idModele']. " : " . $row['nomModele'];
}
while ($row = $resultat3->fetch_assoc()) {
    $optionsscs[] = $row['nomSousCategorie'];
}
while ($row = $resultat4->fetch_assoc()) {
    $optionsf[] = $row['idFournisseur'] . " : " . $row['nomFournisseur'];
}
while ($row = $resultat5->fetch_assoc()) {
    $optionsc[] = $row['nomCategorie'];
}
?>
<?php

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $numSerie = $_POST["numSerie"];
    $type = $_POST["idtype"];
    $modele = $_POST["idmodele"];
    $categorie = $_POST["nomcategorie"];
    $souscategorie = $_POST["nomsouscategorie"];
    $fournisseur = $_POST["idfournisseur"];


    // Préparation de la requête SQL d'insertion
    $requete = "INSERT INTO article (numSerie, idType, idModele, nomCategorie, nomSousCategorie, idFournisseur) VALUES ('$numSerie', '$type', '$modele', '$categorie', '$souscategorie', '$fournisseur')";
    $stmt = $connexion->prepare($requete);
    $stmt->execute();

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Ajouter un article</title>
<link rel="stylesheet" href="../../public/css/styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
        
<body class="bg-light">
<main class="container">
<br>
<!-- formulaire d'ajout d'utilisateur -->
<div>
<!-- avec la methode POST, toutes les informatiions reçus seront envoyé à la page 'resultat.php' qui elle fera l'action d'ajout souhaité avec le code php-->
			<form class="row g-6" method="POST" action="#">

				<div class="col-md-7 col-lg-8">
                    <h4 class="mb-3"><b>Ajouter un matériel</b></h4>

					<div class="row g-3">
						<div class="col-sm-8">
							<label for="numSerie" class="form-label">NumSérie</label> <input
								type="number" class="form-control" id="numSerie" name="numSerie" required>
						</div>
						


						<div class="col-sm-6">
							<label for="idtype" class="form-label">Type </label> <select
								class="form-select" id="idtype" name="idtype" required>
								<!-- faire un dropdown des 2 options -->
                <?php
                echo "<option value=''></option>";
                foreach ($optionst as $optiont) {
                    echo "<option value='$optiont'>$optiont</option>";
                }
                ?> 
              </select>
						</div>


						<div class="col-sm-6">
							<label for="idmodele" class="form-label">Modèle </label> <select
								class="form-select" id="idmodele" name="idmodele">
								<!-- faire un dropdown des options -->
                <?php
                echo "<option value=''></option>";
                foreach ($optionsm as $optionm) {
                    echo "<option value='$optionm'>$optionm</option>";
                }
                ?>   
              </select>
						</div>


						<div class="col-sm-6">
                            <label for="nomcategorie" class="form-label">Catégorie </label>
                            <select class="form-select" id="nomcategorie" name="nomcategorie" onchange="updateSubcategories()" required>
                                <!-- Faire un dropdown des options -->
                                <option value=''></option>
                                <?php foreach ($optionsc as $optionc) {
                                    echo "<option value='$optionc'>$optionc</option>";
                                } ?>
                            </select>
                        </div>


						<div class="col-sm-6">
                            <label for="nomsouscategorie" class="form-label">Sous-Catégorie </label>
                            <select class="form-select" id="nomsouscategorie" name="nomsouscategorie" required>
                                <option value=''></option>
                                <?php foreach ($optionsscs as $optionsc) {
                                    echo "<option value='$optionsc'>$optionsc</option>";
                                } ?>
                            </select>
                        </div>



						<div class="col-sm-6">
							<label for="idfournisseur" class="form-label">Fournisseur </label> <select
								class="form-select" id="idfournisseur" name="idfournisseur" required>
								<!-- faire un dropdown des 2 options -->
                				<option value=''></option>
                                <?php foreach ($optionsf as $optionf) {
                                    echo "<option value='$optionf'>$optionf</option>";
                                } ?>
                      </select>
        			</div>
        			
        			
<!--						<div class="col-sm-6">-->
<!--							<label for="datesortie" class="form-label">Date de sortie</label> <input-->
<!--								type="datetime-local" class="form-control" id="datesortie" name="datesortie">-->
<!--						</div>-->
						
						
						
						<div>
							<!-- les boutons -->
							<div class="button">
								<button type="submit" class="btn btn-primary">Ajouter</button>
							</div>
							<div class="button">
								<button type="reset" class="btn btn-primary">Effacer</button>
							</div>
							<div class="button">
								<button type="button" class="btn btn-primary"
									onclick="quitter()">Quitter</button>
							</div>
						</div>
						
                                   

					
				</div>
			</form>

		</div>

</main>
<br>



<!-- include de la table des articles -->
<?php 
include 'tableArticle.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script>
          function quitter() {
                // Rediriger l'utilisateur vers la page d'accueil
                window.location.href = "../../index.php";
            }
    </script>
    
    <script>
    function updateSubcategories() {
        var selectedCategory = document.getElementById("nomcategorie").value;
        var subcategoryDropdown = document.getElementById("nomsouscategorie");

        // Envoyer une requête AJAX au serveur pour récupérer les sous-catégories associées à la catégorie sélectionnée
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "#", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                // Mettre à jour le menu déroulant des sous-catégories avec les options récupérées
                subcategoryDropdown.innerHTML = response.subcategories;
            }
        };
        xhr.send("selectedCategory=" + encodeURIComponent(selectedCategory));
    }
</script>
    

</body>
</html>
