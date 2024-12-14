<?php
    $control = $_POST['control'];

    include 'gestion_users.php';
    include 'gestion_commandes.php';
    include 'admin_Gusers.php';
    include 'admin_Gcommandes.php';
    include 'gp_Gcommandes.php';

    $user = new G_users();
    $commande = new G_commande();
    $del = new Admin();
    $com = new admin_commandes();
    $gp = new gp_commandes();

    if($control=="inscription"){
        $prenom=ucwords($_POST['prenom']);
        $nom=strtoupper($_POST['nom']);
        $name=$prenom." ".$nom;
        $username=strtolower($_POST['username']);
        $email=$_POST['email'];
        $indic=$_POST['indicatif'];
        $num=$_POST['phone'];
        $phone=$indic.$num;
        $adress=strtolower($_POST['adress']);
        $password0=$_POST['password0'];
        $password1=$_POST['password1'];
        
        $user -> Inscription($name, $username, $email, $phone, $adress, $password0, $password1);
    }

    if ($control == "verify_otp") {
        session_start();
        $otp = $_POST['otp'];
    
        $user -> verify_otp($otp);
    }
    
    if($control=="connexion"){
        $username=strtolower($_POST['username']);
        $password=$_POST['password'];
        
        $user -> Connexion($username, $password);
    }
    
    if ($control == "recup") {
        $mail = $_POST['mail'];
    
        $user -> recup_mail($mail);
    }

    if ($control == "newpass") {
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        $mail = $_POST['mail'];
    
        $user -> recup_pass($password1,$password2,$mail);
    }
    
    if($control=="creer_commande"){
        $produits=$_POST['product'];
        $quantite=$_POST['quantity'];
        $origine=$_POST['origine'];
        $destination=$_POST['destination'];
        $proprietaire=$_POST['proprietaire_name'];
        $indic=$_POST['indicatif'];
        $num=$_POST['phone'];
        $phone=$indic.$num;
        $description=$_POST['notes'];

        $commande -> creer_commande($produits, $quantite, $origine, $destination, $proprietaire, $phone, $description);
    }

    if($control=="mettre_jour"){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $adress=$_POST['adresse'];
        $user_id=$_POST['user_id'];
        
        $user -> mettre_jour($username, $email, $adress, $user_id);
    }
  
    if($control=="mettre_jourad"){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $adress=$_POST['adresse'];
        $user_id=$_POST['user_id'];
        
        $del -> mettre_jourad($username, $email, $adress, $user_id);
    }
  
    if($control=="gpmettre_jour"){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $adress=$_POST['adresse'];
        $user_id=$_POST['user_id'];
        
        $user -> mettre_jourgp($username, $email, $adress, $user_id);
    }

    if($control=="motpass"){
        $password0=$_POST['password0'];
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        $user_id=$_POST['user_id'];
        
        $user -> motpass($password0, $password1, $password2, $user_id);
    }
    
    if($control=="gpmotpass"){
        $password0=$_POST['password0'];
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        $user_id=$_POST['user_id'];

       $user -> motpassgp($password0, $password1, $password2, $user_id);
    }

    if($control=="motpassad"){
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        $user_id=$_POST['user_id'];

       $del -> motpassad($password1, $password2, $user_id);
    }

    if($control=="delete"){
        $id=$_POST['del'];
        $user_id=$_POST['id'];

        $del -> delete_users($id, $user_id);
    }

    if($control=="update"){
        $id=$_POST['up'];
        
        header("location: ../VUE/interface_admin/update_users.php?id=$id");
        exit();
    }
    
    if($control=="admin") {
        $id=$_POST['role'];
        $role="admin";

        $del -> role_users($id, $role);
    }elseif($control=="gp") {
        $id=$_POST['role'];
        $role="gp";

        $del -> role_users($id, $role);
    }elseif($control=="utilisateur") {
        $id=$_POST['role'];
        $role="utilisateur";

        $del -> role_users($id, $role);
    }

    if($control=="rechercher") {
        $recherche=$_POST['recherche'];
        header("location: ../VUE/interface_admin/users_recherche.php?recherche=$recherche");
        exit();
    }

    if($control=="detail"){
        $id=$_POST['idC'];
        $user_id=$_POST['idU'];
        
        header("location: ../VUE/interface_admin/details_commandes.php?id=$id&user_id=$user_id");
        exit();
    }

    if($control=="en attente") {
        $id=$_POST['status'];
        $status="en attente";

        $com -> status_commandes($id, $status);
    }elseif($control=="en cours") {
        $id=$_POST['status'];
        $status="en cours";

        $com -> status_commandes($id, $status);
    }elseif($control=="livrée") {
        $id=$_POST['status'];
        $status="livree";

        $com -> status_commandes($id, $status);
    }

    if($control=="gp id") {
        $gp_id=$_POST['gp'];
        $com_id=$_POST['com_id'];

        $com -> affectation($gp_id, $com_id);
    }

    if($control=="detail_gp"){
        $id=$_POST['idC'];
        $user_id=$_POST['idU'];
        
        header("location: ../VUE/interface_gp/details_commandes.php?id=$id&user_id=$user_id");
        exit();
    }

    if($control=="gp en attente") {
        $id=$_POST['status'];
        $status="en attente";

        $gp -> status_commandes($id, $status);
    }elseif($control=="gp en cours") {
        $id=$_POST['status'];
        $status="en cours";

        $gp -> status_commandes($id, $status);
    }elseif($control=="gp livrée") {
        $id=$_POST['status'];
        $status="livree";

        $gp -> status_commandes($id, $status);
    }

    if($control=="delete_gp"){
        $id=$_POST['del'];

        $gp -> delete_commandes($id);
    }

    if($control=="delete_admin"){
        $id=$_POST['del'];

        $com -> delete_commandes($id);
    }

    if($control=="delete_user"){
        $id=$_POST['del'];

        $commande -> delete_commandes($id);
    }

    if($control=="contact"){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        $user -> contact($name, $email, $subject, $message);
    }
?>