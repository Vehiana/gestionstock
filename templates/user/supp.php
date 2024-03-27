<?php
// require de la connexion à la base de données
require '../../config/db.php';

// Vérifiez si l'ID de l'utilisateur à supprimer est passé en POST
if(isset($_POST['idUser']) OR isset($_POST['numSerie'])) {
    // Échappez les données pour éviter les injections SQL
    $idUser = $connexion->real_escape_string($_POST['idUser']);
    $numSerie = $connexion->real_escape_string($_POST['numSerie']);
    
    // supprimer l'utilisateur de la base de données
    $requete_suppUser = "DELETE FROM utilisateur WHERE idUser = '$idUser'";
    $requete_suppAffecter = "DELETE FROM affecter WHERE idUser = '$idUser' or numSerie = '$numSerie'";
    $requete_suppArticle = "DELETE FROM article WHERE numSerie = '$numSerie'";
    
    // Exécution de la requête
    if ($connexion->query($requete_suppUser) === TRUE) {
        if ($connexion->query($requete_suppAffecter) === TRUE) {
            echo "L'utilisateur a été supprimé avec succès.";
        }
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $connexion->error;
    }
    
    if ($connexion->query($requete_suppArticle) === TRUE) {
        if ($connexion->query($requete_suppAffecter) === TRUE) {
            echo "Le matériel a été supprimé avec succès.";
        }
    } else {
        echo "Erreur lors de la suppression du matériel : " . $connexion->error;
    }
    
    // Fermer la connexion à la base de données
    $connexion->close();
}
?>
