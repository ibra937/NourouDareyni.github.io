<?php
    class admin_commandes {
        function status_commandes($id, $status){
            // Requête pour récupérer les commandes
            include 'connexionDB.php';
            $sql = "UPDATE commandes_produits SET status = :status WHERE id = :user_id"; // Remplacez 'commandes' par le nom de votre table
            $newStatus = $conn->prepare($sql);
            $newStatus->bindParam(':status', $status);
            $newStatus->bindParam(':user_id', $id);
            $newStatus->execute();

            if($newStatus->execute()){
               header("location: ../VUE/interface_admin/commandes_attentes.php"); 
               exit(); 
            }
        }

        function affectation($gp_id, $com_id) {
            include 'connexionDB.php';
            try{
                $sql =  "UPDATE commandes_produits SET gp_id = :gp_id WHERE id = :com_id"; // Remplacez 'commandes' par le nom de votre table
                $affect = $conn->prepare($sql);
                $affect->bindParam(':gp_id', $gp_id);
                $affect->bindParam(':com_id', $com_id);
                $affect->execute();

                if($affect->execute()){
                   header("location: ../VUE/interface_admin/commandes_attentes.php"); 
                   exit(); 
                }
            } catch (PDOException $e) {
                // Gestion d'erreur
                echo "Erreur lors de la mise à jour : " . $e->getMessage();
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
                header("location: ../VUE/interface_admin/commandes_attentes.php"); 
                exit(); 
            }
        }
    }
?>