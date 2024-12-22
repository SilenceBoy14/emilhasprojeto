<?php
require('db.php');

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $cidID = $_POST['id'];
    $cidNome = trim($_POST['nome']);
    $cidUf = trim($_POST['estado']);

    $q = "UPDATE cidades SET nome = ?, estado = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $q);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssi', $cidNome, $cidUf, $cidID);
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            // Usando Bootstrap para mensagem de sucesso
            $mensagem = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Dados atualizados com sucesso!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            // Redirecionamento comentado para exibir a mensagem na mesma página
            //header('Location: index.php');
            //exit;
        } else {
            $mensagem = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Erro ao atualizar os dados: " . mysqli_error($con) . "
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
        }
        mysqli_stmt_close($stmt);
    } else {
        $mensagem = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Erro na preparação da query: " . mysqli_error($con) . "
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
    }
}

// ... (resto do código para obter os dados da cidade)
if (!isset($_GET['id'])) {
    header('Location: .');
    exit;
} else {
    $cidID = $_GET['id'];
    $q = "SELECT * FROM cidades WHERE id = ?";
    $stmt = mysqli_prepare($con, $q);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $cidID);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $cidade = mysqli_fetch_assoc($resultado);
        } else {
            echo "<p>Cidade não encontrada.</p>";
            exit;
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Erro na preparação da query.</p>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cidade</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            max-width: 600px; /* Largura máxima para o container */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Cidade</h1>

        <?php if (isset($mensagem)) echo $mensagem; ?>

        <form method="post" action="editar.php?id=<?= $cidade['id'] ?>">
            <input type="hidden" name="id" value="<?= $cidade['id'] ?>">

            <div class="form-group">
                <label for="nome">Nome da Cidade:</label>
                <input type="text" class="form-control" name="nome" id="nome" required value="<?= htmlspecialchars($cidade['nome']) ?>">
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" name="estado" id="estado" required value="<?= htmlspecialchars($cidade['estado']) ?>">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>