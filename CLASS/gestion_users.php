<?php
    class G_users{

        function Inscription($name, $username, $email, $phone, $adress, $password){
            $password_crypt = password_hash($password, PASSWORD_BCRYPT);

            include 'connexionDB.php';

            try {
                $sql = "INSERT INTO users(nom, user, email, telephone, adresse, password) VALUES(?, ?, ?, ?, ?, ?)";
                $ins = $conn->prepare($sql);
                $ins->execute([$name, $username, $email, $phone, $adress, $password_crypt]);
            
                // Vérifie si l'insertion a réussi
                if ($ins) {
                    header("Location: ../VUE/interface_user/Page_connexion.php");
                    exit();
                }
            } catch (PDOException $e) {
                // En cas d'erreur, redirige vers la page d'inscription
                header("Location: ../VUE/interface_user/Page_inscription.php");
                exit();
            } 
        }

        function Connexion($username, $password){
            include 'connexionDB.php'; 
            
            try{
                $sql = "SELECT * FROM users WHERE user = ?";
                $con = $conn->prepare($sql);
                $con->execute([$username]);
                $result = $con->fetch(PDO::FETCH_ASSOC);

                // Vérification du mot de passe
                if ($result && password_verify($password, $result['password'])) {
                    // Mot de passe valide, connexion réussie
                    if($result['role']=="utilisateur") {
                        session_start();
                        $_SESSION['user_id'] = $result['id'];
                        $_SESSION['name'] = $result['nom']; 
                        $_SESSION['user_name'] = $result['user'];
                        header("Location: ../VUE/interface_user/Accueil.php"); 
                        exit();
                    } elseif($result['role']=="admin"){
                        session_start();
                        $_SESSION['user_id'] = $result['id'];
                        $_SESSION['name'] = $result['nom']; 
                        $_SESSION['user_name'] = $result['user'];
                        header("Location: ../VUE/interface_admin/admin.php"); 
                        exit();
                    }elseif ($result['role']=="gp"){
                        session_start();
                        $_SESSION['user_id'] = $result['id'];
                        $_SESSION['name'] = $result['nom']; 
                        $_SESSION['user_name'] = $result['user'];
                        header("Location: ../VUE/interface_gp/Accueilgp.php"); 
                        exit();
                    }else {
                        $mess="Nom d'utilisateur ou mot de passe incorrect.";
                        header("Location: ../VUE/interface_user/Accueil.php?connexion=$mess");
                    }
                } else {
                    // Mot de passe ou utilisateur incorrect
                    $mess="Nom d'utilisateur ou mot de passe incorrect.";
                    header("Location: ../VUE/interface_user/Accueil.php?connexion=$mess"); 
                }
            } catch (PDOException $e) {
                echo ("Erreur: ".$e);
            }
        }

        function Mettre_jour($username, $email, $adress, $user_id){
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
                    header("Location: ../VUE/interface_user/Profile.php?update=$mess"); 
                    exit();
                }else{
                    $mess="Mise a jour echoué !";
                    header("Location: ../VUE/interface_user/Profile.php?update=$mess"); 
                    exit();
                }
            }catch (PDOException $e){
                $mess="Erreur !";
                header("Location: ../VUE/interface_user/Profile.php?update=$mess"); 
                exit();
            }
        }
        
        function motpass($password1, $password2, $user_id){
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
                    header("Location: ../VUE/interface_user/Profile.php?pass=$mess");
                    exit();
                } else {
                    $mess = "Mise à jour échouée !";
                    header("Location: ../VUE/interface_user/Profile.php?pass=$mess");
                    exit();
                }
            }
        }
        
        function motpassgp($password1, $password2, $user_id){
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
                    header("Location: ../VUE/interface_gp/Profil.php?pass=$mess");
                    exit();
                } else {
                    $mess = "Mise à jour échouée !";
                    header("Location: ../VUE/interface_gp/Profil.php?pass=$mess");
                    exit();
                }
            }
        }
        
        
        function Mettre_jourgp($username, $email, $adress, $user_id){
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
                    header("Location: ../VUE/interface_gp/Profil.php?update=$mess"); 
                    exit();
                }else{
                    $mess="Mise a jour echoué !";
                    header("Location: ../VUE/interface_gp/Profil.php?update=$mess"); 
                    exit();
                }
            }catch (PDOException $e){
                $mess="Erreur !";
                header("Location: ../VUE/interface_gp/Profil.php?update=$mess"); 
                exit();
            }
        }
    }
?>