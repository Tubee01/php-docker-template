<?php
try {
    // env.POSTGRES_SERVER = Docker container name
    $host = 'database';
    // env.POSTGRES_USER 
    $user = 'admin';
    // env.POSTGRES_PASSWORD
    $password = 'longestpassword';
    // Test db inited in - ~/database/init/init.sql
    $db = 'master';
    //
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";

    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


    if ($pdo) {
        $sth = $pdo->prepare("SELECT * FROM Urak");
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_OBJ);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
