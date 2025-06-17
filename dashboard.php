<?php
require_once 'includes/conexao.php';

// Proteção da página
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$stmt = $conexao->prepare("SELECT login FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Meus Livros</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <nav>
        <a href="dashboard.php">Início</a>
        <a href="livros.php">Meus Livros</a>
        <a href="novo_livro.php">Adicionar Livro</a>
        <a href="logout.php">Sair</a>
    </nav>
    <div class="container">
        <h2>Bem-vindo(a), <?php echo htmlspecialchars($usuario['login']); ?>!</h2>
        <p>Este é o seu painel de controle. Use o menu acima para navegar pelo sistema e gerenciar sua coleção de livros.</p>
    </div>
</body>
</html>