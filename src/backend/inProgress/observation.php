<?php
require __DIR__ . '/../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $observation = $_POST['observation'] ?? null;

    try {
        $stmt = $pdo->prepare('UPDATE services SET observation = :observation WHERE id = :id');
        $stmt->bindValue(':observation', $observation, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: ../../../pages/inProgress/');
        exit;
    } catch (PDOException $e) {
        echo "Erro ao adicionar observação: " . $e->getMessage();
    }
}
