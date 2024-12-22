<?php
require('db.php');


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega o comentário do formulário
    global $con;
    $comentario = $_POST['comentario'];
    $dataPublicacao = date("Y-m-d H:i:s");
    
    $stmt = $con->prepare("INSERT INTO comentarios ( comentario, datapub) VALUES ( ?,  $dataPublicacao)");

    //$stmt->bind_param("s", $comentario);

    
    // Executa a query
    if ($stmt->execute()) {
        // Redireciona de volta para a página da cidade
        header("Location: cidade.php?id="); 
        exit();
    } else {
        // Se houver um erro na inserção, exibe uma mensagem
        echo "Erro ao adicionar o comentário: " . $stmt->error;
    }

    $stmt->close();
}

?>