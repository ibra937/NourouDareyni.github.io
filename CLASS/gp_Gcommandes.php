<?php
    class gp_commandes {
        function status_commandes($id, $status){
            // Requête pour récupérer les commandes
            include 'connexionDB.php';
            $sql = "UPDATE commandes_produits SET status = :status WHERE id = :user_id"; // Remplacez 'commandes' par le nom de votre table
            $newStatus = $conn->prepare($sql);
            $newStatus->bindParam(':status', $status);
            $newStatus->bindParam(':user_id', $id);
            $newStatus->execute();

            if($newStatus->execute()){
               header("location: ../VUE/interface_gp/gestion_commandes.php"); 
               exit(); 
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
                header("location: ../VUE/interface_gp/gestion_commandes.php"); 
                exit(); 
            }
        }
    }
?>