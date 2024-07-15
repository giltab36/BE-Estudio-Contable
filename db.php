<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'be_contable';
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    try {
        $conection = new mysqli($host, $user, $password, $db);
        $conection->set_charset("utf8mb4");
    } catch (mysqli_sql_exception $e) {
        echo "Error en la conexión: " . $e->getMessage();
        exit();
    }
?>