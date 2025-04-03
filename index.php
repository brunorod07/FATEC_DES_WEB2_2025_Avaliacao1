<?php
session_start();

// Definindo as credenciais de login
$usuarios = [
    'professor' => password_hash('professor', PASSWORD_DEFAULT),
    'biblio' => password_hash('biblio', PASSWORD_DEFAULT)
];

// Verificando se o formulário de login foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = $_POST['senha'];

    if (isset($usuarios[$usuario]) && password_verify($senha, $usuarios[$usuario])) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = $usuario;
        header('Location: welcome.php');
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos!';
    }
}

// Realizando logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Acessar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        body {
            font: 14px sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .wrapper {
            width: 350px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            background-color: white;
            text-align: center;
        }
        .form-group label {
            display: block;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Acessar</h2>
        <p>Por favor, insira seu login e senha.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Login</label>
                <input type="text" name="usuario" class="form-control" required value="<?php echo htmlspecialchars($_POST['usuario'] ?? ''); ?>">
            </div>    
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Acessar">
            </div>
        </form>
        <?php if (isset($erro)) { echo "<p class='text-danger'>$erro</p>"; } ?>
    </div>    
</body>
</html>
