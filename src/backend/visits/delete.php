<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['visit_id'] ?? null;

    $id = filter_input(INPUT_POST, 'visit_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID da Visita é inválido.";
        header('Location: /davidServices/pages/visits');
        exit;
    }

    try {
        $stmt = $pdo->prepare('DELETE FROM visits WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Visita deletado com sucesso.";
        } else {
            $_SESSION['error_message'] = "Visita não encontrado.";
        }

        header('Location: /davidServices/pages/visits');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao Deletar Visita: " . $e->getMessage();
        header('Location: /davidServices/pages/visits');
        exit;
    }
}
