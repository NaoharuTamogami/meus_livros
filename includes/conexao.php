<?php
// /includes/conexao.php

// Iniciar a sessão. 
session_start();

$servidor = 'localhost';
$usuario_db = 'root';
$senha_db = ''; // Padrão XAMPP sem senha
$banco = 'meus_livros';

// Criar a conexão mysqli
$conexao = new mysqli($servidor, $usuario_db, $senha_db, $banco);

// Checar a conexão
if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

// Definir o charset para utf8mb4 para suportar caracteres especiais
$conexao->set_charset("utf8mb4");

// Variável para armazenar mensagens de feedback para o usuário
$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']); // Limpa a mensagem depois de exibi-la
}
