<?php
session_start();

// Verificando se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo</title>
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
        <h1>Bem-vindo, <?php echo ucfirst($usuario); ?>!</h1>
        <p>O que deseja fazer?</p>

        <a href="visualizar_livros.php" class="btn btn-info">Visualizar livros cadastrados</a><br><br>

        <?php if ($usuario === 'biblio') { ?>
            <a href="visualizar_pedidos.php" class="btn btn-warning">Visualizar pedidos</a><br><br>
            <a href="cadastrar_livros.php" class="btn btn-success">Cadastrar livro</a><br><br>
        <?php } elseif ($usuario === 'professor') { ?>
            <a href="cadastrar_pedidos.php" class="btn btn-primary">Cadastrar pedido de livro</a><br><br>
        <?php } ?>

        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>  
</body>
</html>
