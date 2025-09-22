<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

// Detecta de onde veio a requisição para redirecionar corretamente
function getRedirectUrl()
{
    $referer = $_SERVER['HTTP_REFERER'] ?? '';

    if (strpos($referer, '/inProgress') !== false) {
        return '../../../pages/inProgress';
    } elseif (strpos($referer, '/notStart') !== false) {
        return '../../../pages/notStart';
    } elseif (strpos($referer, '/ready') !== false) {
        return '../../../pages/ready';
    }

    // Fallback padrão
    return '../../../pages/inProgress';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['service_id'] ?? null;

    $id = filter_input(INPUT_POST, 'service_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID de Serviço inválido.";
        header('Location: ' . getRedirectUrl());
        exit;
    }

    try {
        $stmt = $pdo->prepare('DELETE FROM services WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Serviço deletado com sucesso.";
        } else {
            $_SESSION['error_message'] = "Serviço não encontrado.";
        }

        header('Location: ' . getRedirectUrl());
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao Deletar Serviço: " . $e->getMessage();
        header('Location: ' . getRedirectUrl());
        exit;
    }
}
