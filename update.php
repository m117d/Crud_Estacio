<?php
require 'db.php';

// Verifica se o ID foi passado via GET
if (!isset($_GET['id'])) {
    die("ID não fornecido.");
}

$id = $_GET['id'];

// Verifica se o formulário foi submetido (via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $tipo_id = $_POST['tipo_id'];
    $nome = $_POST['nome'];
    $status = $_POST['status'];

    // Atualiza os dados no banco de dados
    $stmt = $pdo->prepare('UPDATE midia SET tipo_id = ?, nome = ?, status = ? WHERE id = ?');
    $stmt->execute([$tipo_id, $nome, $status, $id]);

    // Redireciona para a página inicial após a atualização
    header('Location: index.php');
    exit(); // Termina o script após redirecionar
} else {
    // Se não foi submetido via POST, carrega os dados atuais do item
    $stmt = $pdo->prepare('SELECT m.id, m.nome, m.tipo_id, m.status FROM midia m WHERE m.id = ?');
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se encontrou o item
    if (!$item) {
        die("Item não encontrado.");
    }

    // Seleciona os tipos de mídia para preencher o dropdown
    $stmt_tipos = $pdo->query('SELECT id, tipo FROM tipo_midia');
    $tipos_midia = $stmt_tipos->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Item</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Adicionando o estilo CSS externo -->
    <style>
        /* Estilos específicos para a página de edição */
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Ajuste opcional para espaçamento */
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Item</h1>
        <form method="post">
            <label for="tipo_id">Tipo de Mídia</label>
            <select id="tipo_id" name="tipo_id" required>
                <?php foreach ($tipos_midia as $tipo): ?>
                    <option value="<?= htmlspecialchars($tipo['id'], ENT_QUOTES, 'UTF-8') ?>" <?= ($tipo['id'] == $item['tipo_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tipo['tipo'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="nome">Nome da Mídia</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Assistida" <?= ($item['status'] == 'Assistida') ? 'selected' : '' ?>>Assistida</option>
                <option value="Não Assistida" <?= ($item['status'] == 'Não Assistida') ? 'selected' : '' ?>>Não Assistida</option>
                <option value="Em Andamento" <?= ($item['status'] == 'Em Andamento') ? 'selected' : '' ?>>Em Andamento</option>
                <option value="Terminada" <?= ($item['status'] == 'Terminada') ? 'selected' : '' ?>>Terminada</option>
            </select>

            <button type="submit">Salvar</button>
        </form>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
