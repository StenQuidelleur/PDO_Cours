<?php

require 'config/connect.php';

$pdo = new PDO(DSN, USER, PASS);
if( $pdo === false) {
    echo 'Connection Error :' .$pdo->error_log();
}

include('CRUD/read.php');
