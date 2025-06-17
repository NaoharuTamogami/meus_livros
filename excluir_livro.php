<?php
require_once 'includes/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$livro_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($livro_id > 0) {
    // A query só deleta se o ID do livro e o ID do usuário baterem, garantindo a segurança
    $stmt = $conexao->prepare("DELETE FROM livros WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $livro_id, $usuario_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['mensagem'] = "Livro excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Não foi possível excluir. Talvez o livro não exista ou você não tenha permissão.";
        }
    } else {
        $_SESSION['mensagem'] = "Erro ao tentar excluir o livro.";
    }
} else {
    $_SESSION['mensagem'] = "ID do livro inválido.";
}

header("Location: livros.php");
exit();