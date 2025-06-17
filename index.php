<?php
require_once 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['login']) && !empty($_POST['senha'])) {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $stmt = $conexao->prepare("SELECT id, senha FROM usuarios WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                header("Location: dashboard.php");
                exit();
            }
        }
        $_SESSION['mensagem'] = "Login ou senha inválidos.";
    } else {
        $_SESSION['mensagem'] = "Por favor, preencha todos os campos.";
    }
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Meus Livros</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Meus Livros</h1>
    </header>
    <div class="container">
        <div class="form-container">
            <h2>Acessar o Sistema</h2>
            <?php if (!empty($mensagem)): ?>
                <p class="mensagem erro"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <form action="index.php" method="POST">
                <input type="text" name="login" placeholder="Seu login" required>
                <input type="password" name="senha" placeholder="Sua senha" required>
                <button type="submit">Entrar</button>
            </form>
            <div class="link-container">
                <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
            </div>
        </div>
    </div>
</body>
</html>