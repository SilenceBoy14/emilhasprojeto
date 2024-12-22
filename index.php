<?php
require 'functions.php';

// Obter todas as cidades
$cidades = getCidades();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melhorias para a Cidade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between; /* Alinha os links para a direita */
            align-items: center; /* Alinha verticalmente */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Melhorias para a Cidade</h1>

        <h2>Cidades Disponíveis</h2>
        <ul class="list-group">
            <?php foreach ($cidades as $cidade): ?>
                <li class="list-group-item">
                    <a href="cidade.php?id=<?php echo $cidade['id']; ?>">
                        <?php echo htmlspecialchars($cidade['nome']); ?>, <?php echo htmlspecialchars($cidade['estado']); ?>
                    </a>
                    <div> <a href="editar.php?id=<?php echo htmlspecialchars($cidade['id']); ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="remover.php?id=<?php echo htmlspecialchars($cidade['id']); ?>" class="btn btn-sm btn-danger ml-1" onclick="return confirm('Tem certeza que deseja excluir esta cidade?')">Excluir</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <br>
        <a href="add_cidade.php" class="btn btn-success">Adicionar Nova Cidade</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>