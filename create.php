<?php
require 'db.php';

// Seleciona os tipos de mídia para preencher o dropdown
$stmt = $pdo->query('SELECT id, tipo FROM tipo_midia');
$tipos_midia = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_id = $_POST['tipo_id'];
    $nome = $_POST['nome'];
    $status = $_POST['status'];

    // Insere os dados no banco de dados
    $stmt = $pdo->prepare('INSERT INTO midia (tipo_id, nome, status) VALUES (?, ?, ?)');
    $stmt->execute([$tipo_id, $nome, $status]);

    // Redireciona para a página inicial após a inserção
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Item</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Novo Item</h1>
        <form method="post">
            <label for="tipo_id">Tipo de Mídia</label>
            <select id="tipo_id" name="tipo_id" required>
                <?php foreach ($tipos_midia as $tipo): ?>
                    <option value="<?= htmlspecialchars($tipo['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($tipo['tipo'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label for="nome">Nome da Mídia</label>
            <input type="text" id="nome" name="nome" required>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Assistida">Assistida</option>
                <option value="Não Assistida">Não Assistida</option>
                <option value="Em Andamento">Em Andamento</option>
                <option value="Terminada">Terminada</option>
            </select>
            
            <button type="submit">Salvar</button>
        </form>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
