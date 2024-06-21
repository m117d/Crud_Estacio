<?php
require 'db.php';

// Verifica se o ID foi passado via GET
if (!isset($_GET['id'])) {
    die("ID não fornecido.");
}

$id = $_GET['id'];

// Prepara e executa a consulta para deletar o item
$stmt = $pdo->prepare('DELETE FROM midia WHERE id = ?');
$stmt->execute([$id]);

// Redireciona para a página inicial após a exclusão
header('Location: index.php');
exit(); // Termina o script após redirecionar
?>
