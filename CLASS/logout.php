<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // Détruit la session pour déconnecter l'utilisateur
    session_destroy();
    
    // Redirige vers la page de connexion avec un message de succès
    header("Location: ../VUE/interface_user/Page_connexion.php?message=Deconnexion%20réussie");
    exit();
} else {
    // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
    header("Location: ../VUE/interface_user/Page_connexion.php?message=Vous%20n'%C3%AAtes%20pas%20connect%C3%A9");
    exit();
}
?>