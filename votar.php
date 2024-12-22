<?php
    require 'functions.php';

    // Obter os dados do formulário
    $idMelhoria = $_POST['id_melhoria'];
    $idUsuario = $_POST['id_usuario'];
    $voto = $_POST['voto'];

    // Registrar o voto
    votarMelhoria($idMelhoria, $idUsuario, $voto);

    // Redirecionar para a página da cidade com as melhorias
    header("Location: cidade.php?id=$idMelhoria");
    exit();
?>
