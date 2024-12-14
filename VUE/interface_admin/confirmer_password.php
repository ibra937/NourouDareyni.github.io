<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../interface_user/Page_connexion.php");
        exit();
    }
    $user_id=$_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="VUE/media/logo-tete.png">
    <link rel="stylesheet" href="Style_admin.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    include 'sidebar.php';
    $control = $_POST['control'];
    $id=$_POST['del'];
    ?>
    <div class='container'>
        <img src="../media/Confirmed-amico.png" style="width: 50%; height: 300px; margin-left: 25%;">
        <h2> Etes-vous sure de vouloir supprimer cette commandes?</h2>
        <form action='../../CLASS/control.php' method='POST'>
            <input type="hidden" name="control" value="<?php echo($control); ?>">
            <input type="hidden" name="del" value="<?php echo($id); ?>">
            <button class='del-btn'>Oui</button>
        </form><br>
        <button class='del-btn'><a href='commandes_attentes.php'>Non</a></button>
    </div>
</body>
</html>