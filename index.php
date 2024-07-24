<?php
require 'db.php';

try {
    // Seleciona todos os itens e junta com a tabela tipo_midia para obter o nome do tipo
    $stmt = $pdo->query('SELECT m.id, m.nome AS title, tm.tipo AS media_type, m.status
                         FROM midia m
                         JOIN tipo_midia tm ON m.tipo_id = tm.id');
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die('Erro ao buscar itens do banco de dados: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Mídias</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Filmes, Séries e Desenhos</h1>
        <a href="create.php">Adicionar Novo Item</a>
        <ul>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <li>
                        <a href="read.php?id=<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($item['media_type'], ENT_QUOTES, 'UTF-8') ?>)
                        </a>
                        <a href="update.php?id=<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?>">Editar</a>
                        <a href="delete.php?id=<?= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8') ?>" onclick="return confirm('Tem certeza que deseja deletar este item?')">Deletar</a>
                        <p>Status: <?= htmlspecialchars($item['status'], ENT_QUOTES, 'UTF-8') ?></p>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Nenhum item encontrado.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
