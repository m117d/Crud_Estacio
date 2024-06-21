<?php
require 'db.php';
$stmt = $pdo->query('SELECT * FROM items');
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Mídias</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Lista de Filmes, Séries e Desenhos</h1>
    <a href="create.php">Adicionar Novo Item</a>
    <ul>
        <?php foreach ($items as $item): ?>
            <li>
                <a href="read.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?> (<?= htmlspecialchars($item['media_type']) ?>)</a>
                <a href="update.php?id=<?= $item['id'] ?>">Editar</a>
                <a href="delete.php?id=<?= $item['id'] ?>">Deletar</a>
                <p>Status: <?= htmlspecialchars($item['status']) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
