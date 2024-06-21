<?php
require 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM items WHERE id = ?');
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($item['title']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1><?= htmlspecialchars($item['title']) ?> (<?= htmlspecialchars($item['media_type']) ?>)</h1>
    <p>Status: <?= htmlspecialchars($item['status']) ?></p>
    <p><?= nl2br(htmlspecialchars($item['description'])) ?></p>
    <p><strong>Ano de Lançamento:</strong> <?= $item['release_year'] ?></p>
    <p><strong>Gênero:</strong> <?= htmlspecialchars($item['genre']) ?></p>
    <a href="index.php">Voltar</a>
</body>
</html>
