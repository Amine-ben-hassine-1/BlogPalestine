<?php
define('SERVERNAME', 'localhost');
define('DATABASE', 'php2');
define('USERNAME', 'root');
define('PASSWORD', '');



try {
    $conn = new PDO ("mysql:host=".SERVERNAME.";dbname=".DATABASE, USERNAME, PASSWORD);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch(PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
}