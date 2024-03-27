<!-- page d'accueil -->
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Gestion des stocks</title>
<link rel="stylesheet" href="public/css/styles.css" >
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body> 

	<div class="container">
	
	<!-- le header -->
		<header class="border-bottom lh-1 py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-3">
					<a href="/accueil"><img class="logo-container"
						src="public/images/polylogo.jpeg" alt="logo Polynésie 1ère"></a>
				</div>
				<div class="col-6 text-center">
					<a class="blog-header-logo text-body-emphasis text-decoration-none">GESTION DES STOCKS</a>
				</div>
				
				<div class="col-5">
                    <a class="btn btn-warning" href="templates/user/GestionUtil.php">Gestion des utilisateurs</a>
                      <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Menu
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="templates/user/monProfil.php"><i class="bi bi-person-fill"></i> Mon Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="templates/login/Deconnexion.php"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
                      </ul>
				</div>			
			</div>
		</header>
	
	<br>
	
	<!-- formulaire de recherche d'article (dans la bdd) -->
	<!-- en fonction des éléments sélectionnés, afficher que ce qui concerne cette élément -->
		<form class="container" method="POST" action="fetch_results.php">
		
		<!-- un petit formulaire de recherche avec input et select(options) -->
		<div class="search-container">
		
			<!-- NUM SERIE -->
			<input type="number" placeholder="Numéro de serie" id="numSerie">
			
			
			<!-- TYPES -->
			<select	id="nomType" onchange="fetchArticles()">
    			<?php
    			$connexion = new mysqli("localhost", "root", "", "gestionstock");
    			
    			if ($connexion->connect_error) {
    			    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    			}
                    // Requête SQL pour récupérer les types disponibles
                    $requeteTypes = "SELECT DISTINCT nomType FROM article JOIN type ON article.idType=type.idType";
                    $resultatTypes = $connexion->query($requeteTypes);
        
                    // Afficher les options du sélecteur
                    echo "<option value''>Types</option>";
                    while ($row = $resultatTypes->fetch_assoc()) {
                        echo "<option value='" . $row['nomType'] . "'>" . $row['nomType'] . "</option>";
                    }
                    ?>
			</select>
			
			
			<!-- MODELES -->
			<select	id="nomModele" onchange="fetchArticles()">
    			<?php

                    // Requête SQL pour récupérer les types disponibles
                    $requeteModeles = "SELECT DISTINCT nomModele FROM article JOIN modele ON article.idModele=modele.idModele";
                    $resultatModeles = $connexion->query($requeteModeles);
        
                    // Afficher les options du sélecteur
                    echo "<option value''>Modèles</option>";
                    while ($row = $resultatModeles->fetch_assoc()) {
                        echo "<option value='" . $row['nomModele'] . "'>" . $row['nomModele'] . "</option>";
                    }
                    ?>
			</select>
			
			
			<!-- CATEGORIES -->
			<select id="nomCategorie" onchange="fetchArticles()">
                <?php
                // Requête SQL pour récupérer les catégories disponibles
                $requeteCat = "SELECT DISTINCT nomCategorie FROM article";
                $resultatCat = $connexion->query($requeteCat);
        
                // Afficher les options du sélecteur
                echo "<option value=''>Catégories</option>"; // Correction: value='' au lieu de value''
                while ($row = $resultatCat->fetch_assoc()) {
                    echo "<option value='" . $row['nomCategorie'] . "'>" . $row['nomCategorie'] . "</option>";
                }
                ?>
             </select>
             
             
             <!-- SOUS-CATEGORIES -->
			 <select id="nomSousCategorie" onchange="fetchArticles()">
                <?php
                // Requête SQL pour récupérer les sous-catégories disponibles
                $requeteSousCat = "SELECT DISTINCT nomSousCategorie FROM article";
                $resultatSousCat = $connexion->query($requeteSousCat);
        
                // Afficher les options du sélecteur
                echo "<option value=''>Sous-catégories</option>"; 
                while ($row = $resultatSousCat->fetch_assoc()) {
                    echo "<option value='" . $row['nomSousCategorie'] . "'>" . $row['nomSousCategorie'] . "</option>";
                }
                ?>
            </select>
            
            
			<select id="nomFournisseur" onchange="fetchArticles()">
    			<?php
                // Requête SQL pour récupérer les sous-catégories disponibles
                $requeteFourn = "SELECT nomFournisseur FROM fournisseur";
                $resultatFourn = $connexion->query($requeteFourn);
        
                // Afficher les options du sélecteur
                echo "<option value=''>Fournisseur</option>"; 
                while ($row = $resultatFourn->fetch_assoc()) {
                    echo "<option value='" . $row['nomFournisseur'] . "'>" . $row['nomFournisseur'] . "</option>";
                }
                ?>
			</select>



<!-- redirige vers le formulaire d'ajout d'article -->
			<button type="button" onclick="redirigerAjouter()">Ajouter</button>
			<button type="button" onclick="redirigerAffecter()">Affecter</button>
			
		</div>
			
		</form>
	</div>
	
	<br>
	
	<main class="container">
<!-- afficher la table avec les informations -->
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">N° série</th>
                    <th scope="col">Matériel</th>
                    <th scope="col">Sous-catégorie</th>
                    <th scope="col">Date Arrivée</th>
                    <th scope="col">Date Sortie</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider" id="tableBody">
            <?php
                               
                // Requête SQL pour récupérer tous les éléments de la table article
                $requete = "SELECT numSerie, nomType, nomModele, nomCategorie, nomSousCategorie, dateArr, dateSortie FROM article JOIN type ON article.idType=type.idType JOIN modele ON article.idModele=modele.idModele ORDER BY dateArr DESC LIMIT 13";
                $resultat = $connexion->query($requete);
                
                // Afficher les résultats
                while ($row = $resultat->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['numSerie'] . "</td>";
                    echo "<td>" . $row['nomType'] . " - " . $row['nomModele'] . "</td>";
                    echo "<td>" . $row['nomCategorie'] . " / " . $row['nomSousCategorie'] . "</td>";
                    echo "<td>" . $row['dateArr'] . "</td>";
                    echo "<td>" . $row['dateSortie'] . "</td>";
                    echo "</tr>";
                }
                
                // Fermer la connexion à la base de données
                $connexion->close();
                ?>
            
                <!-- Les résultats seront affichés ici -->
            </tbody>
        </table>
    </div>
    </main>

    <script>
        function fetchArticles() {
		// Récupérer les éléments sélectionnées
		var selectnumSerie = document.getElementById("numSerie").value;
        var selectType = document.getElementById("nomType");
        var selectModele = document.getElementById("nomModele");
        var selectCat = document.getElementById("nomCategorie");
        var selectSousCat = document.getElementById("nomSousCategorie");
        var selectFourn = document.getElementById("nomFournisseur");

        // Récupérer les valeurs des éléments sélectionnées
        var type = selectType.value;    
        var modele = selectModele.value;
        var categorie = selectCat.value;
        var souscategorie = selectSousCat.value;
        var fournisseur = selectFourn.value;
        

        // Appel AJAX pour récupérer les articles en fonction de l'option sélectionné
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tableBody").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "fetch_results.php?numSerie=" + numSerie + "&type=" +  type + "&modele=" + modele + "&categorie=" + categorie + "&souscategorie=" + souscategorie + "&fournisseur=" + fournisseur, true);
        xhttp.send();
    }
    </script>

	<script>		
        function redirigerAjouter() {
            // Rediriger l'utilisateur vers la page d'ajout d'un article
            window.location.href = "templates/article/AjoutArticle.php";
        }
        
        function redirigerAffecter() {
        //se rediriger vers la page de modification de l'article
        	window.location.href = "templates/article/affectationArti.php";
        }
        
    </script>
    
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<!-- inclure le footer à la page -->
<?php 
    include 'app/includes/footer.php';
?>

</body>

</html>