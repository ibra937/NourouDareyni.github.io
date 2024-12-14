<?php
    class Admin {
        public function pagination() {
            $commandes_par_page = 10;

            // Page actuelle (paramètre dans l'URL)
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $page = max($page, 1); // Assure que la page soit au moins 1
                    
            // Calcul de l'OFFSET
            $offset = ($page - 1) * $commandes_par_page;
                    
            // Récupérer le nombre total de commandes pour l'utilisateur
            $sql_count = "SELECT COUNT(*) as total_commandes FROM commandes_produits WHERE user_id = ?";
            $count = $conn->prepare($sql_count);
            $count->execute([$_SESSION['user_id']]);
            $total_commandes = $count->fetch(PDO::FETCH_ASSOC)['total_commandes'];
                    
            // Calcul du nombre total de pages
            $total_pages = ceil($total_commandes / $commandes_par_page);
        }

        function delete_users($id, $user_id){
            // Requête pour récupérer les commandes
            include 'connexionDB.php';

            $sql = "DELETE FROM commandes_produits WHERE user_id=?"; // Remplacez 'commandes' par le nom de votre table
            $delete = $conn->prepare($sql);
            $delete->execute([$user_id]);


            $sql = "DELETE FROM users WHERE id=?"; // Remplacez 'commandes' par le nom de votre table
            $delete = $conn->prepare($sql);
            $delete->execute([$id]);

            if($delete->execute()){
                $mess="";
                header("location: ../VUE/interface_admin/page_users.php"); 
                exit(); 
            }
        }

        function role_users($id, $role) {
             // Requête pour récupérer les commandes
             include 'connexionDB.php';
             $sql = "UPDATE users SET role = :role WHERE id = :user_id"; // Remplacez 'commandes' par le nom de votre table
             $newRole = $conn->prepare($sql);
             $newRole->bindParam(':role', $role);
             $newRole->bindParam(':user_id', $id);
             $newRole->execute();
 
             if($newRole->execute()){
                header("location: ../VUE/interface_admin/page_users.php"); 
                exit(); 
             }
        }

        function Mettre_jourad($username, $email, $adress, $user_id){
            include 'connexionDB.php';

            try{
                $sql = "UPDATE users SET user = :user, email = :email, adresse = :adresse WHERE id = :user_id";
                $up = $conn -> prepare($sql);
                $up->bindParam(':user', $username);
                $up->bindParam(':email', $email);
                $up->bindParam(':adresse', $adress);
                $up->bindParam(':user_id', $user_id);
                $up->execute();
                
                if($up->execute()){
                    $mess="Mise a jour reussie !";
                    header("Location: ../VUE/interface_admin/update_users.php?update=$mess"); 
                    exit();
                }else{
                    $mess="Mise a jour echoué !";
                    header("Location: ../VUE/interface_admin/update_users.php?update=$mess");  
                    exit();
                }
            }catch (PDOException $e){
                $mess="Erreur !";
                header("Location: ../VUE/interface_admin/update_users.php?update=$mess");  
                exit();
            }
        }

        function motpassad($password1, $password2, $user_id){
            include 'connexionDB.php';
            
            if($password1 == $password2) {
                $password = $password1;
                $password_crypt = password_hash($password, PASSWORD_BCRYPT);
                
                $sql = "UPDATE users SET password = :password WHERE id = :user_id";
                $pass = $conn->prepare($sql);
                $pass->bindParam(':password', $password_crypt); // Utiliser le mot de passe haché
                $pass->bindParam(':user_id', $user_id); // Assurez-vous que $user_id existe et est bien défini
                
                if ($pass->execute()) {
                    $mess = "Mot de passe changé avec succès!";
                    header("Location: ../VUE/interface_admin/page_users.php?pass=$mess");
                    exit();
                } else {
                    $mess = "Mise à jour échouée !";
                    header("Location: ../VUE/interface_admin/page_users.php?pass=$mess");
                    exit();
                }
            }
        }
    }
?>