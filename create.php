<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $media_type = $_POST['media_type'];
    $title = $_POST['title'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    
    $stmt = $pdo->prepare('INSERT INTO items (media_type, title, status, description, release_year, genre) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$media_type, $title, $status, $description, $release_year, $genre]);
    
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Item</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Adicionar Novo Item</h1>
    <form method="post">
        <label for="media_type">Tipo de Mídia:</label>
        <select id="media_type" name="media_type" required>
            <option value="Filme">Filme</option>
            <option value="Serie">Série</option>
            <option value="Desenho">Desenho</option>
        </select>
        <br>
        <label for="title">Nome da Mídia:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Assistida">Assistida</option>
            <option value="Não Assistida">Não Assistida</option>
            <option value="Em Andamento">Em Andamento</option>
            <option value="Terminada">Terminada</option>
        </select>
        <br>
        <label for="description">Descrição:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <label for="release_year">Ano de Lançamento:</label>
        <input type="number" id="release_year" name="release_year">
        <br>
        <label for="genre">Gênero:</label>
        <input type="text" id="genre" name="genre">
        <br>
        <button type="submit">Salvar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
