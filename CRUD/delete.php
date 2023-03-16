<?php

require '../config/connect.php';

$pdo = new PDO(DSN, USER, PASS);
if ($pdo === false) {
    echo 'Connection Error :' .$pdo->error_log();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    try { 
        $request = $pdo->prepare("DELETE FROM user WHERE id=:id");
        $request->bindValue(':id', $id);
        $request->execute();
        header('Location: http://localhost:8888/PDO_Cours/index.php');
    } catch (PDOException $e){ 
        echo $e->getMessage();
    }
}