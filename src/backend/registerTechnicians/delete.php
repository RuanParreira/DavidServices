<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['technical_id'] ?? null;

    $id = filter_input(INPUT_POST, 'technical_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID do Técnico inválido.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }

    try {
        $stmt = $pdo->prepare('DELETE FROM technicians WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Técnico deletado com sucesso.";
        } else {
            $_SESSION['error_message'] = "Técnico não encontrado.";
        }

        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao Deletar Técnico: " . $e->getMessage();
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }
}
