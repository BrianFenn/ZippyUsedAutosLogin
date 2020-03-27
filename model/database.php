<?php
    $dsn = 'mysql:host=dyud5fa2qycz1o3v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=v81fh0xf9phpukqa';
    $username = 's6hatnjwkzgiq33x';
    $password = 'i1o53knv8g93sbhl';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
