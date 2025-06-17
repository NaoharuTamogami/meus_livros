<?php
require_once 'includes/conexao.php';

// Proteção
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consulta para buscar apenas os livros do usuário logado
$stmt = $conexao->prepare("SELECT id, titulo, autor, descricao FROM livros WHERE usuario_id = ? ORDER BY titulo ASC");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Livros</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Meus Livros</h1>
    </header>
    <nav>
        <a href="dashboard.php">Início</a>
        <a href="livros.php">Meus Livros</a>
        <a href="novo_livro.php">Adicionar Livro</a>
        <a href="logout.php">Sair</a>
    </nav>
    <div class="container">
        <div class="table-container">
            <h2>Sua Coleção de Livros</h2>
            <?php if (!empty($mensagem)): ?>
                <p class="mensagem sucesso"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado->num_rows > 0): ?>
                        <?php while ($livro = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                                <td>
                                    <a href="editar_livro.php?id=<?php echo $livro['id']; ?>">Editar</a> |
                                    <a href="excluir_livro.php?id=<?php echo $livro['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este livro?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Você ainda não cadastrou nenhum livro.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>