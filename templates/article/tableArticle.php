<!-- le contenu principal de l'accueil -->
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
				<tbody class="table-group-divider">
					<tr>

			<!-- code php qui permet d'ajouter les éléments de la bdd dans la table -->
               <?php
            // Connexion à la base de données 
            require '../../config/db.php';

            // Requête SQL pour récupérer les données
            $requete = "SELECT numSerie, nomType, nomModele, nomCategorie, nomSousCategorie, dateArr, dateSortie FROM article JOIN type ON article.idType=type.idType JOIN modele ON article.idModele=modele.idModele order by dateArr desc";
            $resultat = $connexion->query($requete);

            //pour chaque article, il y a un bouton propre à l'article -> regarder le TD Mme HAMON
            //le bouton de l'index cliqué, accède à une page où il n'y a que des infos de cet article
            
            // Afficher les données dans le tableau HTML
            while ($row = $resultat->fetch_assoc()) {
                echo "<tr>";
                $numSerie = $row['numSerie'];
                echo "<td>" . $row['numSerie'] . "</td><td>" . $row['nomType'] . " - " . $row['nomModele'] . "</td>";
                echo "<td>" . $row['nomCategorie'] . " / " . $row['nomSousCategorie'] . "</td>";
                echo "<td>" . $row['dateArr'] . "</td>";
                echo "<td>" . $row['dateSortie'] . "</td>";
                echo "<td>". "<i class='bi bi-trash3-fill' onclick='supprimer($numSerie)' style='color: rgb(255,0,0)'></i>" . "</td>";
                echo "</tr>";
            }

            // Fermer la connexion à la base de données
            $connexion->close();
            ?>
				
				</tbody>
			</table>
		</div>
		
		<script>
	function supprimer(numSerie) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce matériel ?")) {
            // Créer un objet XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurer la requête
            xhr.open("POST", "../user/supp.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Définir ce qui se passe lorsque la requête est terminée
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Afficher la réponse du serveur
                    location.reload(); // Recharger la page après la suppression
                }
            };

            // Envoyer la requête avec l'ID à supprimer
            xhr.send("numSerie=" + numSerie);
        }
    }
</script>

</main>
