<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $observation = $_POST['observation'] ?? null;

    try {
        $stmt = $pdo->prepare('UPDATE services SET observation = :observation WHERE id = :id');
        $stmt->bindValue(':observation', $observation, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success_message'] = 'Observação alterada com sucesso!';
        header('Location: ../../../pages/inProgress');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao adicionar observação: ' . $e->getMessage();
        header('Location: ../../../pages/inProgress');
        exit;
    }
}
