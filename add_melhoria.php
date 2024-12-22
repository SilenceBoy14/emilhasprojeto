<?php
require 'functions.php';

// Verificar se o ID da cidade foi fornecido E se é um número
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger' role='alert'>ID da cidade inválido.</div>";
    exit;
}

$idCidade = $_GET['id'];

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = trim($_POST['titulo']); // Limpa espaços em branco antes e depois
    $descricao = trim($_POST['descricao']);
    $categoria = trim($_POST['categoria']);

    // Validação dos dados (IMPORTANTE!)
    if (empty($titulo) || empty($descricao) || empty($categoria)) {
        $mensagem = "<div class='alert alert-warning' role='alert'>Por favor, preencha todos os campos.</div>";
    } else {

        $dataPublicacao = date("Y-m-d H:i:s");

        if (addMelhoria($idCidade, $titulo, $descricao, $categoria, $dataPublicacao)) {
            $mensagem = "<div class='alert alert-success' role='alert'>Melhoria adicionada com sucesso!</div>";
            // Redirecionamento após alguns segundos (melhor UX)
            header("refresh:2;url=cidade.php?id=$idCidade");
        } else {
            $mensagem = "<div class='alert alert-danger' role='alert'>Erro ao adicionar a melhoria.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Melhoria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Adicionar Melhoria para a Cidade</h1>

        <?php if (isset($mensagem)) echo $mensagem; ?>

        <form action="add_melhoria.php?id=<?php echo $idCidade; ?>" method="POST">
            <div class="form-group">
                <label for="titulo">Título da Melhoria:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição da Melhoria:</label>
                <textarea class="form-control" name="descricao" id="descricao" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" class="form-control" name="categoria" id="categoria" required>
            </div>

            <button type="submit" class="btn btn-primary">Adicionar Melhoria</button>
            <a href="cidade.php?id=<?php echo $idCidade; ?>" class="btn btn-secondary">Voltar para a cidade</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>