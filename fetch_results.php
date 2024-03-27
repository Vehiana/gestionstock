<?php
if(isset($_GET['numSerie']) OR isset($_GET['type']) OR isset($_GET['modele']) OR isset($_GET['categorie']) OR isset($_GET['souscategorie']) OR isset($_GET['fournisseur'])) {
    $numSerie = $_GET['numSerie'];
    $nomType = $_GET['type'];
    $nomModele = $_GET['modele'];
    $nomCategorie = $_GET['categorie'];
    $nomSousCategorie = $_GET['souscategorie'];
    $nomFournisseur = $_GET['fournisseur'];
    
    
    // Connexion à la base de données
    $connexion = mysqli_connect("localhost", "root", "", "gestionstock");
    
    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    }
    
    // Requête SQL pour récupérer les articles en fonction des options sélectionnées
    $requete = "SELECT numSerie, nomType, nomModele, nomCategorie, nomSousCategorie, dateArr, dateSortie FROM article JOIN type ON article.idType=type.idType JOIN modele ON article.idModele=modele.idModele JOIN fournisseur ON article.idFournisseur=fournisseur.idFournisseur WHERE numSerie='$numSerie' OR nomType = '$nomType' OR nomModele= '$nomModele' OR nomCategorie = '$nomCategorie' AND nomSousCategorie = '$nomSousCategorie' OR nomFournisseur = '$nomFournisseur' ORDER BY dateArr DESC";
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
}
?>
