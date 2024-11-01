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
    <link rel="stylesheet" href="style_admin.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    include 'sidebar.php';
    $control = $_POST['control'];
    $id=$_POST['del'];
    ?>
    <div class='container'>
    <h2> Etes-vous sure de vouloir supprimer cette commandes?</h2>
    <form action='../../CLASS/control.php' method='POST'>
    <input type="hidden" name="control" value="<?php echo($control); ?>">
    <input type="hidden" name="del" value="<?php echo($id); ?>">
    <button class='del-btn'>Oui</button>
    </form><br>
    <button class='del-btn'><a href='gestion_commandes.php'>Non</a></button>
    </div>
</body>
</html>