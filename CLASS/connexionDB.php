<?php
    $dns = 'mysql:host=localhost;dbname=gpdb';
    $user = 'Ibra';
    $pass = 'maiseck23';
    
    try {
        $conn = new PDO($dns, $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    
?>