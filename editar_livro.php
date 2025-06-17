<?php
require_once 'includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$livro_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lógica para salvar alterações (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['titulo']) && !empty($_POST['autor'])) {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $descricao = $_POST['descricao'];
        $id_post = (int)$_POST['id'];

        $stmt = $conexao->prepare("UPDATE livros SET titulo = ?, autor = ?, descricao = ? WHERE id = ? AND usuario_id = ?");
        $stmt->bind_param("sssii", $titulo, $autor, $descricao, $id_post, $usuario_id);

        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Livro atualizado com sucesso!";
            header("Location: livros.php");
            exit();
        } else {
            $mensagem = "Erro ao atualizar. Tente novamente.";
        }
    } else {
        $mensagem = "Título e autor são obrigatórios.";
    }
}

// Lógica para buscar o livro para edição (GET)
if ($livro_id > 0) {
    $stmt = $conexao->prepare("SELECT id, titulo, autor, descricao FROM livros WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $livro_id, $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows === 1) {
        $livro = $resultado->fetch_assoc();
    } else {
        $_SESSION['mensagem'] = "Livro não encontrado ou você não tem permissão para editá-lo.";
        header("Location: livros.php");
        exit();
    }
} else {
    header("Location: livros.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header><h1>Editar Livro</h1></header>
     <nav>
        <a href="dashboard.php">Início</a>
        <a href="livros.php">Meus Livros</a>
        <a href="novo_livro.php">Adicionar Livro</a>
        <a href="logout.php">Sair</a>
    </nav>
    <div class="container">
        <div class="form-container">
            <h2>Alterar Informações do Livro</h2>
             <?php if (!empty($mensagem)): ?>
                <p class="mensagem erro"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <form action="editar_livro.php?id=<?php echo $livro['id']; ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">
                <input type="text" name="titulo" placeholder="Título" value="<?php echo htmlspecialchars($livro['titulo']); ?>" required>
                <input type="text" name="autor" placeholder="Autor" value="<?php echo htmlspecialchars($livro['autor']); ?>" required>
                <textarea name="descricao" placeholder="Descrição"><?php echo htmlspecialchars($livro['descricao']); ?></textarea>
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>
</body>
</html>