<?php
require_once 'includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['titulo']) && !empty($_POST['autor'])) {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descricao = $_POST['descricao'];
        $usuario_id = $_SESSION['usuario_id'];

        $stmt = $conexao->prepare("INSERT INTO livros (usuario_id, titulo, autor, descricao) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $usuario_id, $titulo, $autor, $descricao);
        
        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Livro cadastrado com sucesso!";
            header("Location: livros.php");
            exit();
        } else {
            $mensagem = "Erro ao cadastrar o livro. Tente novamente.";
        }
    } else {
        $mensagem = "Título e autor são campos obrigatórios.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Livro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header><h1>Adicionar Novo Livro</h1></header>
    <nav>
        <a href="dashboard.php">Início</a>
        <a href="livros.php">Meus Livros</a>
        <a href="novo_livro.php">Adicionar Livro</a>
        <a href="logout.php">Sair</a>
    </nav>
    <div class="container">
        <div class="form-container">
            <h2>Informações do Livro</h2>
            <?php if (!empty($mensagem)): ?>
                <p class="mensagem erro"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <form action="novo_livro.php" method="POST">
                <input type="text" name="titulo" placeholder="Título do Livro" required>
                <input type="text" name="autor" placeholder="Autor do Livro" required>
                <textarea name="descricao" placeholder="Sinopse ou comentários sobre o livro"></textarea>
                <button type="submit">Salvar Livro</button>
            </form>
        </div>
    </div>
</body>
</html>