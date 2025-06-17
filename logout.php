<?php
// /logout.php
require_once 'includes/conexao.php';

// Limpa todas as variáveis da sessão
$_SESSION = array();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login com uma mensagem
header("Location: index.php");
exit();