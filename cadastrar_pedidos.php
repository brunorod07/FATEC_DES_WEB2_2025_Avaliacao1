<?php
session_start();

// Verificando se o usuário é um professor
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'professor') {
    header('Location: login.php'); // Redireciona para a página de login caso o usuário não seja um professor
    exit; // Encerra a execução do script para evitar que o restante do código seja executado
}

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os valores do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $isbn = $_POST['isbn'];

    // Define o nome do arquivo onde os pedidos serão armazenados
    $arquivo = 'pedidos.txt';

    // Formata os dados do pedido para serem salvos no arquivo
    $dados = "$titulo|$autor|$editora|$isbn\n";

    // Escreve os dados no arquivo, adicionando ao final (FILE_APPEND)
    file_put_contents($arquivo, $dados, FILE_APPEND);

    // Mensagem de sucesso
    $sucesso = 'Pedido cadastrado com sucesso!';
}
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pedido de Livro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body { 
            font: 14px sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
            background-color: #f8f9fa;
        }
        .wrapper { 
            width: 400px; 
            padding: 20px; 
            background: white; 
            border-radius: 8px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Cadastrar Pedido de Livro</h1>
        <p>Preencha os dados abaixo.</p>

        <form method="POST">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editora">Editora:</label>
                <input type="text" name="editora" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>

        <?php if (isset($sucesso)) { echo "<p style='color:green;'>$sucesso</p>"; } ?>
        
        <br>
        <a href="welcome.php" class="btn btn-primary">Voltar</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>  
</body>
</html>
