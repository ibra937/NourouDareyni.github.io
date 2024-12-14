<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
    class G_users{

        function Inscription($name, $username, $email, $phone, $adress, $password0, $password1){
            include 'connexionDB.php';
            $sql = "SELECT * FROM users WHERE email = ?";
            $con = $conn->prepare($sql);
            $con->execute([$email]);
            $result = $con->fetch(PDO::FETCH_ASSOC);
            if($result){
                $mess="L'adress email existe déja.";
                header("location: ../VUE/interface_user/Page_inscription.php?inscription=$mess");
                exit();
            } else if ($password0 !== $password1) {
                $mess = "Les deux mots de passe ne correspondent pas.";
                header("location: ../VUE/interface_user/Page_inscription.php?inscription=$mess");
                exit();
            }
        
            $password_crypt = password_hash($password0, PASSWORD_BCRYPT);
            $otp = rand(100000, 999999); // Générer un OTP à 6 chiffres
        
            // Stocker les informations en session
            session_start();
            $_SESSION['otp'] = $otp;
            $_SESSION['user_data'] = [
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'adress' => $adress,
                'password' => $password_crypt
            ];
        
            // Envoyer l'OTP par e-mail
            if ($this->sendOtpEmail($email, $otp)) {
                $mess = "Un code de confirmation (OTP) a été envoyé à votre adresse e-mail.";
                header("Location: ../VUE/interface_user/verify_otp.php?otp_message=$mess");
                exit();
            } else {
                $mess = "Échec de l'envoi du code OTP. Veuillez réessayer.";
                header("Location: ../VUE/interface_user/Page_inscription.php?inscription=$mess");
                exit();
            }
        }

        function sendOtpEmail($email, $otp) {
            // Utilisation de PHPMailer pour envoyer l'OTP
            

            $mail = new PHPMailer(true);
        
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'diakhatei648@gmail.com'; 
                $mail->Password = 'taxjcwrzqkdmekcp'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
        
                $mail->setFrom('diakhatei648@gmail.com', 'Nourou Darayni Services');
                $mail->addAddress($email);
        
                $mail->isHTML(true);
                $mail->Subject = 'Votre code OTP';
                $mail->Body = "
                    Bonjour,<br><br>
                    Votre code OTP est : <strong>$otp</strong><br><br>
                    Ce code est valide pour 10 minutes.
                ";
        
                $mail->send();
                return true;
            } catch (Exception $e) {
                error_log("Erreur d'envoi d'e-mail : {$mail->ErrorInfo}");
                return false;
            }
        }

        function verify_otp($otp){
            $_SESSION['otp_expiration'] = time() + 600; // Expiration dans 10 minutes

            if (time() > $_SESSION['otp_expiration']) {
                unset($_SESSION['otp']);
                unset($_SESSION['otp_expiration']);
                $mess = "Le code OTP a expiré. Veuillez recommencer.";
                header("Location: ../VUE/interface_user/Page_inscription.php?inscription=$mess");
                exit();
            }


            if (isset($_SESSION['otp']) && $otp == $_SESSION['otp']) {
                // L'OTP est correct, insérer les données dans la base
                if (isset($_SESSION['user_data'])){
                    $user_data = $_SESSION['user_data'];
                
                    include 'connexionDB.php';
                
                    try {
                        $sql = "INSERT INTO users(nom, user, email, telephone, adresse, password) VALUES(?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([
                            $user_data['name'],
                            $user_data['username'],
                            $user_data['email'],
                            $user_data['phone'],
                            $user_data['adress'],
                            $user_data['password']
                        ]);
                    
                        // Supprimer les données de session après l'insertion
                        unset($_SESSION['otp']);
                        unset($_SESSION['user_data']);
                    
                        $mess = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                        header("Location: ../VUE/interface_user/Page_connexion.php?connexion=$mess");
                        exit();
                    } catch (PDOException $e) {
                        $mess = "Échec de l'inscription. Veuillez réessayer.";
                        header("Location: ../VUE/interface_user/Page_inscription.php?inscription=$mess");
                        exit();
                    }
                }else{
                    unset($_SESSION['otp']);
                    unset($_SESSION['user_data']);
                    
                    $mail=$_SESSION['mail'];
                    $mess = "Vérification réussie ! Vous pouvez maintenant entrer votre nouvel mot de passe.";
                    header("Location: ../VUE/interface_user/newpass.php?pass=$mess&mail=$mail");
                    exit();
                }
            } else {
                // OTP incorrect
                $mess = "Le code OTP est invalide. Veuillez réessayer.";
                header("Location: ../VUE/interface_user/verify_otp.php?otp_message=$mess");
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
                        header("Location: ../VUE/interface_admin/Admin.php"); 
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

        function recup_mail($mail){

            $email=$mail;
            $otp = rand(100000, 999999);

            session_start();
            $_SESSION['otp']=$otp;
            $_SESSION['mail']=$email;
            include 'connexionDB.php';
            $sql = "SELECT * FROM users WHERE email = ?";
            $con = $conn->prepare($sql);
            $con->execute([$mail]);
            $result = $con->fetch(PDO::FETCH_ASSOC);
            if(!$result){
                $mess="L'adress email n'est as relier a un compte.";
                header("location: ../VUE/interface_user/Page_connexion.php?connexion=$mess");
                exit();
            }else if ($this->sendOtpEmail($email, $otp)) {
                $mess = "Un code de confirmation (OTP) a été envoyé à votre adresse e-mail.";
                header("Location: ../VUE/interface_user/verify_otp.php?otp_message=$mess");
                exit();
            } else {
                $mess = "Échec de l'envoi du code OTP. Veuillez réessayer.";
                header("Location: ../VUE/interface_user/Page_inscription.php?inscription=$mess");
                exit();
            }
        }

        function recup_pass($password1,$password2,$mail){
            if($password1 == $password2) {
                $password = $password1;
                $password_crypt = password_hash($password, PASSWORD_BCRYPT);

                include "connexionDB.php";
                $sql = "UPDATE users SET password = :password WHERE email = :email";
                $pass = $conn->prepare($sql);
                $pass->bindParam(':password', $password_crypt); // Utiliser le mot de passe haché
                $pass->bindParam(':email', $mail); // Assurez-vous que $user_id existe et est bien défini
                $pass->execute();
                if ($pass->execute()) {
                    $mess = "Mot de passe changé avec succès!";
                    header("Location: ../VUE/interface_user/Page_connexion.php?connexion=$mess");
                    exit();
                }
            }else{
                $mess = "Les deux mots de passes ne correspondent pas!";
                header("Location: ../VUE/interface_user/newpass.php?pass=$mess&mail=$mail");
                exit();
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
        
        function motpass($password0, $password1, $password2, $user_id){
            include 'connexionDB.php';
            $sql = "SELECT * FROM users WHERE id = ?";
            $con = $conn->prepare($sql);
            $con->execute([$user_id]);
            $result = $con->fetch(PDO::FETCH_ASSOC);
            // Vérification du mot de passe
            if ($result && password_verify($password0, $result['password'])) {
                
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
                    }
                }else{
                    $mess = "Les deux mots de passes ne correspondent pas!";
                    header("Location: ../VUE/interface_user/Profile.php?pass=$mess");
                    exit();
                }
            } else {
                $mess = "Mise à jour échouée !";
                header("Location: ../VUE/interface_user/Profile.php?pass=$mess");
                exit();
            }
        }
        
        function motpassgp($password0, $password1, $password2, $user_id){
            include 'connexionDB.php';
            $sql = "SELECT * FROM users WHERE id = ?";
            $con = $conn->prepare($sql);
            $con->execute([$user_id]);
            $result = $con->fetch(PDO::FETCH_ASSOC);
            // Vérification du mot de passe
            if ($result && password_verify($password0, $result['password'])) {
            
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
                }else{
                    $mess = "Les deux mots de passes ne correspondent pas!";
                    header("Location: ../VUE/interface_user/Profile.php?pass=$mess");
                    exit();
                }
            } else {
                $mess = "Mise à jour échouée !";
                header("Location: ../VUE/interface_user/Profile.php?pass=$mess");
                exit();
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


        function contact($name, $email, $subject, $message){
            $to = "diakhatei648@gmail.com"; // Remplace par ton adresse email
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
        
            $fullMessage = "Nom: $name\nEmail: $email\nSujet: $subject\n\nMessage:\n$message";
        
            if (mail($to, $subject, $fullMessage, $headers)) {
                echo "Merci, votre message a été envoyé avec succès.";
            } else {
                echo "Erreur, votre message n'a pas pu être envoyé.";
            }
        }
    }
?>