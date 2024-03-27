<!-- le contenu principal de l'accueil -->
<main class="container">
		<!-- afficher la table avec les informations -->
		<div class="table-responsive" style="overflow-x: auto;">
			<table class="table">
				<thead class="table-light">
					<tr>
    					<th scope="col">Nom</th>
						<th scope="col">NumSérie</th>
						<th scope="col">Matériel</th>
						<th scope="col">Sous-catégorie</th>
						<th scope="col">Date d'affectation</th>
                        <th scope="col"></th>

					</tr>
				</thead>
				<tbody class="table-group-divider">

			<!-- code php qui permet d'ajouter les éléments de la bdd dans la table -->
               <?php
            // Connexion à la base de données 
            $connexion = mysqli_connect("localhost", "root", "", "gestionstock");

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("La connexion à la base de données a échoué : " . $connexion->connect_error);
            }

            // Requête SQL pour récupérer les données
            $requete = "SELECT utilisateur.nom, utilisateur.prenom, affecter.numSerie, type.nomType, modele.nomModele, article.nomCategorie, article.nomSousCategorie, affecter.dateAffectation FROM affecter JOIN article ON article.numSerie=affecter.numSerie JOIN utilisateur ON affecter.idUser=utilisateur.idUser JOIN type ON article.idType=type.idType JOIN modele ON article.idModele=modele.idModele";
            $resultat = $connexion->query($requete);

            //pour chaque article, il y a un bouton propre à l'article -> regarder le TD Mme HAMON
            //le bouton de l'index cliqué, accède à une page où il n'y a que des infos de cet article
            
            // Afficher les données dans le tableau HTML
            while ($row = $resultat->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nom'] . " " . $row['prenom'] . "</td>";
                echo "<td>" . $row['numSerie'] . "</td>";
                echo "<td>" . $row['nomType'] . " - " . $row['nomModele'] . "</td>";
                echo "<td>" . $row['nomCategorie'] . " /  " . $row['nomSousCategorie'] . "</td>";
                echo "<td>" . $row['dateAffectation'] . "</td>";
                echo "<td>"."</td>";
                //echo "<td><input type='button' id='modifier_date' onclick='supprimer(". $numSerie .")' style='color: red;'value='Supprimer'/>" . "</td>";
                echo "</tr>";
            }

            // Fermer la connexion à la base de données
            $connexion->close();
            ?>
				
				</tbody>
			</table>
		</div>
</main>
