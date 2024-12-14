<?php
    class G_commande{

        function creer_commande($produits, $quantite, $origine, $destination, $proprietaire, $phone, $description){
            include 'connexionDB.php';
            session_start();
            try {
                $sql = "INSERT INTO commandes_produits(nom_produit, user_id, quantite, origine, destination, proprietaire, tel_propietaire, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                $creer = $conn->prepare($sql);
                $creer->execute([$produits, $_SESSION['user_id'], $quantite, $origine, $destination, $proprietaire, $phone, $description]);

                if($creer){
                    header("Location: ../VUE/interface_user/Page_suiviC.php"); 
                    exit();
                }
            } catch (PDOException $e) {
                echo($e);
            }
        }

        function delete_commandes($id){
            // Requête pour récupérer les commandes
            include 'connexionDB.php';
            $sql = "DELETE FROM commandes_produits WHERE id=?"; // Remplacez 'commandes' par le nom de votre table
            $delete = $conn->prepare($sql);
            $delete->execute([$id]);

            if($delete->execute()){
                $mess="";
                header("location: ../VUE/interface_user/Page_suiviC.php"); 
                exit(); 
            }
        }
    }
?>