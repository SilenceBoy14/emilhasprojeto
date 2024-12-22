<?php
    require 'functions.php';

    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Receber os dados do formulário
        $nome = $_POST['nome'];
        $estado = $_POST['estado'];

        // Adicionar a cidade no banco de dados
        addCidade($nome, $estado);

        // Redirecionar para a página principal (index.php)
        header("Location: index.php");
        exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Cidade</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Nova Cidade</h1>

    <form action="add_cidade.php" method="POST">
        <label for="nome">Nome da Cidade:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="estado">Estado:</label>
        <input type="text" name="estado" id="estado" required><br><br>

        <button type="submit">Adicionar Cidade</button>
    </form>

    <br>
    <a href="index.php">Voltar para a lista de cidades</a>
</body>
</html>
