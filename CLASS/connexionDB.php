<?php
    $dns = 'mysql:host=sql103.infinityfree.com;dbname=if0_37716375_gpdb';
    $user = 'if0_37716375';
    $pass = 'MAIseck2304';
    /*$dns = 'mysql:host=localhost;dbname=GPDB';
    $user = 'root';
    $pass = '';*/
    
    try {
        $conn = new PDO($dns, $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    
?>