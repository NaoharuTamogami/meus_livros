<?php
require_once 'includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // Verificar se login ou email já existem
        $stmt_check = $conexao->prepare("SELECT id FROM usuarios WHERE login = ? OR email = ?");
        $stmt_check->bind_param("ss", $login, $email);
        $stmt_check->execute();
        if ($stmt_check->get_result()->num_rows > 0) {
            $_SESSION['mensagem'] = "Login ou e-mail já está em uso.";
        } else {
            $stmt_insert = $conexao->prepare("INSERT INTO usuarios (login, email, senha) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $login, $email, $senha);

            if ($stmt_insert->execute()) {
                $_SESSION['mensagem'] = "Usuário cadastrado com sucesso! Faça o login.";
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['mensagem'] = "Erro ao cadastrar. Tente novamente.";
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    } else {
        $_SESSION['mensagem'] = "Por favor, preencha todos os campos.";
    }
    header("Location: cadastro.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Meus Livros</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Cadastro de Novo Usuário</h1>
    </header>
    <div class="container">
        <div class="form-container">
            <h2>Crie sua Conta</h2>
            <?php if (!empty($mensagem)): ?>
                <p class="mensagem erro"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <form action="cadastro.php" method="POST">
                <input type="text" name="login" placeholder="Login de usuário" required>
                <input type="email" name="email" placeholder="Seu melhor e-mail" required>
                <input type="password" name="senha" placeholder="Crie uma senha forte" required>
                <button type="submit">Cadastrar</button>
            </form>
            <div class="link-container">
                <p>Já tem uma conta? <a href="index.php">Faça login</a></p>
            </div>
        </div>
    </div>
</body>
</html>