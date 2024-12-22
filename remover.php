<?php

// Verificar se o ID da cidade foi passado pela URL e se é um número válido
if (isset($_GET['id']) && is_numeric($_GET['id']) && trim($_GET['id']) != '') {

    // Converter o ID para um inteiro
    $cidID = (int) $_GET['id'];

    // Incluir o arquivo de conexão com o banco de dados
    require('db.php');

    // Preparar a query para excluir a cidade com o ID informado
    $q = "DELETE FROM cidades WHERE id = ?";  

    // Preparar a consulta
    $stmt = mysqli_prepare($con, $q);

    if ($stmt) {
        // Vincular o parâmetro à consulta preparada
        mysqli_stmt_bind_param($stmt, 'i', $cidID);

        // Executar a consulta
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar se a exclusão foi bem-sucedida
        if ($resultado) {
            // Sucesso na exclusão, redireciona para a listagem de cidades
            header('Location: index.php');
            exit;
        } else {
            // Caso ocorra algum erro na execução da query, exibe o erro
            echo "<p>Erro ao excluir a cidade. Erro: " . mysqli_error($con) . "</p>";
        }

        // Fechar a consulta preparada
        mysqli_stmt_close($stmt);
    } else {
        // Caso a preparação da consulta falhe, exibe o erro
        echo "<p>Erro ao preparar a consulta. Erro: " . mysqli_error($con) . "</p>";
    }
} else {
    // Se o ID não foi passado ou não é válido, redireciona para a listagem de cidades
    header('Location: index.php');
    exit;
}

?>
