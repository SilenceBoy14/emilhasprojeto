<?php
require 'functions.php';

// Obter o ID da cidade
$idCidade = $_GET['id'];


// Obter as melhorias associadas a essa cidade
$melhorias = getMelhoriasByCidade($idCidade);

// Ordenar as melhorias por relevância (maior para menor)
usort($melhorias, function ($a, $b) {
    return $b['relevancia'] <=> $a['relevancia'];
});
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
        .melhoria {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .melhoria h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container"> <h1>Melhorias para a Cidade</h1>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar para a lista de cidades</a>

        <h2>Melhorias Sugeridas</h2>
        <?php foreach ($melhorias as $melhoria): ?>
            <div class="melhoria">
                <h3><?php echo htmlspecialchars($melhoria['titulo']); ?></h3>
                <p><?php echo htmlspecialchars($melhoria['descricao']); ?></p>
                <p><strong>Categoria:</strong> <?php echo htmlspecialchars($melhoria['categoria']); ?></p>
                <p><strong>Relevância:</strong> <?php echo htmlspecialchars($melhoria['relevancia']); ?></p>
                <p><strong>Data de Publicação:</strong> <?php echo htmlspecialchars($melhoria['data_criacao']); ?></p>
                <form action="votar.php" method="post">
                    <input type="hidden" name="id_melhoria" value="<?php echo htmlspecialchars($melhoria['id']); ?>">
                    <input type="hidden" name="id_usuario" value="1">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="voto" id="votoPositivo<?php echo $melhoria['id']; ?>" value="1">
                        <label class="form-check-label" for="votoPositivo<?php echo $melhoria['id']; ?>">Voto Positivo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="voto" id="votoNegativo<?php echo $melhoria['id']; ?>" value="0">
                        <label class="form-check-label" for="votoNegativo<?php echo $melhoria['id']; ?>">Voto Negativo</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Votar</button>
                </form>
            </div>
        <?php endforeach; ?>
        <a href="add_melhoria.php?id=<?php echo htmlspecialchars($idCidade); ?>" class="btn btn-success mb-3">Adicionar Melhoria</a>

        <h2>Deixe seu comentário sobre a cidade</h2>
        <?php if (isset($mensagem)) echo $mensagem; ?>
        <form method="post" action="" class="mb-5">
            <div class="form-group">
                <label for="comentario">Comentário:</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <!-- Nós tentamos, mas os comentarios não quiseram funcionar :( -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>