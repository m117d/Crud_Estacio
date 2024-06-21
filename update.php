<?php
require 'db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $media_type = $_POST['media_type'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    
    $stmt = $pdo->prepare('UPDATE items SET media_type = ?, title = ?, status = ?, description = ?, release_year = ?, genre = ?, updated_at = now() WHERE id = ?');
    $stmt->execute([$media_type, $title, $status, $description, $release_year, $genre, $id]);
    
    header('Location: index.php');
} else {
    $stmt = $pdo->prepare('SELECT * FROM items WHERE id = ?');
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Item</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Editar Item</h1>
    <form method="post">
        <label for="media_type">Tipo de Mídia:</label>
        <select id="media_type" name="media_type" required>
            <option value="Filme" <?= $item['media_type'] == 'Filme' ? 'selected' : '' ?>>Filme</option>
            <option value="Serie" <?= $item['media_type'] == 'Serie' ? 'selected' : '' ?>>Série</option>
            <option value="Desenho" <?= $item['media_type'] == 'Desenho' ? 'selected' : '' ?>>Desenho</option>
        </select>
        <br>
        <label for="title">Nome da Mídia:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($item['title']) ?>" required>
        <br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Assistida" <?= $item['status'] == 'Assistida' ? 'selected' : '' ?>>Assistida</option>
            <option value="Não Assistida" <?= $item['status'] == 'Não Assistida' ? 'selected' : '' ?>>Não Assistida</option>
            <option value="Em Andamento" <?= $item['status'] == 'Em Andamento' ? 'selected' : '' ?>>Em Andamento</option>
            <option value="Terminada" <?= $item['status'] == 'Terminada' ? 'selected' : '' ?>>Terminada</option>
        </select>
        <br>
        <label for="description">Descrição:</label>
        <textarea id="description" name="description"><?= htmlspecialchars($item['description']) ?></textarea>
        <br>
        <label for="release_year">Ano de Lançamento:</label>
        <input type="number" id="release_year" name="release_year" value="<?= $item['release_year'] ?>">
        <br>
        <label for="genre">Gênero:</label>
        <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($item['genre']) ?>">
        <br>
        <button type="submit">Salvar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
