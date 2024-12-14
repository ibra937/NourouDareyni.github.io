<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container-form">
        <form action="../../CLASS/control.php" method="POST">
            <?php 
                $otp_message=$_GET['otp_message'];
                echo($otp_message);
            ?>
            <label for="otp">Entrez votre code OTP :</label>
            <input type="text" id="otp" name="otp" pattern="\d{6}" title="Le code doit contenir 6 chiffres." required>
            <button type="submit" name="control" value="verify_otp">Vérifier</button>
        </form>
    </div>
</body>
</html>