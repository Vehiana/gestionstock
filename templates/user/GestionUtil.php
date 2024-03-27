<?php
 // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: ../login/Connexion.php");
    exit(); 
  } 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Gestion des utilisateurs</title>
<link rel="stylesheet" href="../../public/css/styles.css" >
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body> 

	<div class="container">
	
	<!-- le header -->
		<header class="border-bottom lh-1 py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-3">
					<a href="../../index.php"><img class="logo-container"
						src="../../public/images/polylogo.jpeg" alt="logo Polynésie 1ère"></a>
				</div>
				<div class="col-6 text-center">
					<a class="blog-header-logo text-body-emphasis text-decoration-none"
						href="#">GESTION DES UTILISATEURS</a>
				</div>
                				<!-- Example single danger button -->
                <div class="col-5">
                    <a class="btn btn-warning" href="../../index.php">Gestion des stocks</a>
                      <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Menu
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="monProfil.php"><i class="bi bi-person-fill"></i> Mon Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../login/Deconnexion.php"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
                      </ul>
				</div>
				
			</div>
		</header>
	
	<br>

<!-- le contenu principal de l'accueil -->
<main class="container">
		<!-- afficher la table avec les informations -->
		<div class="table-responsive" style="overflow-x: auto;">
		<div>
		<a href="Inscription.php"><i class="bi bi-plus-circle"></i></a>
		</div>
			<table class="table">
				<thead class="table-light">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nom</th>
						<th scope="col">Prénom</th>
						<th scope="col">Login</th>
						<!-- <th scope="col">Mot de passe (hash)</th> -->
						<th scope="col">Profil</th>
						<th scope="col">Date de création</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody class="table-group-divider">
					<tr>

			<!-- code php qui permet d'ajouter les éléments de la bdd dans la table -->
               <?php
               // require de la connexion à la base de données
               require '../../config/db.php';

                // Requête SQL pour récupérer les données à afficher
                $requete = "SELECT idUser, nom, prenom, login, idprofil, createdAt FROM utilisateur order by nom asc;";
                $resultat = $connexion->query($requete);
                
                // Afficher les données dans le tableau
                while ($row = $resultat->fetch_assoc()) {
                    echo "<tr>";
                    $idUser = $row['idUser'];
                    echo "<td>" . $row['idUser'] . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['prenom']. "</td>";
                    echo "<td>" . $row['login'] . "</td>";
                    echo "<td>" . $row['idprofil'] . "</td>";
                    echo "<td>" . $row['createdAt'] . "</td>";
                    echo "<td>". "<i class='bi bi-trash3-fill' onclick='supprimer($idUser)' style='color: rgb(255,0,0)'></i>" . "</td>";
                    echo "</tr>";
                }
    
                // Fermer la connexion à la base de données
                $connexion->close();
                ?>
				
				</tbody>
			</table>
		</div>
</main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
	function supprimer(idUser) {
		if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
			// Créer un objet XMLHttpRequest
			var xhr = new XMLHttpRequest();
			
			// Configurer la requête
			xhr.open("POST", "supp.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			
			// Définir ce qui se passe lorsque la requête est terminée
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200) {
					alert(xhr.responseText); // Afficher la réponse du serveur
					location.reload(); // Recharger la page après la suppression
				}
			};
			
			// Envoyer la requête avec l'ID de l'utilisateur à supprimer
			xhr.send("idUser=" + idUser);
		}
	}
</script>

</body>
</html>


