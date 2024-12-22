<?php
    $host = 'localhost';
    $db = 'cidade_melhorias';
    $user = 'root';
    $password = '';
    $port = 3306; // 3307

    $con = mysqli_connect( $host, $user, $password, $db, $port );
    
    if ($con->connect_error) {
        die("Falha na conexão: " . $con->connect_error);
    }
?>
