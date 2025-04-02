<?php
session_start();

// Verificando se o usuário é um bibliotecário
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'biblio') {
    header('Location: login.php');
    exit;
}

$pedidos = file('pedidos.txt', FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos de Livros</title>
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
            width: 600px; 
            padding: 20px; 
            background: white; 
            border-radius: 8px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Pedidos de Livros</h1>
        <table>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>ISBN</th>
            </tr>
            <?php foreach ($pedidos as $pedido) {
                list($titulo, $autor, $editora, $isbn) = explode('|', $pedido);
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($titulo); ?></td>
                    <td><?php echo htmlspecialchars($autor); ?></td>
                    <td><?php echo htmlspecialchars($editora); ?></td>
                    <td><?php echo htmlspecialchars($isbn); ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="welcome.php" class="btn btn-primary">Voltar</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
