<?php
// Arquivo de configuração do banco de dados
$host = 'localhost'; // Host do banco de dados
$dbname = 'Estacio'; // Nome do banco de dados
$username = 'postgres'; // Usuário do banco de dados
$password = '2510@'; // Senha do banco de dados

$dsn = "pgsql:host=$host;dbname=$dbname;";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erro de conexão: ' . $e->getMessage());
}
?>
