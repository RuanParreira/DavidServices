<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['client_id'] ?? null;

    $id = filter_input(INPUT_POST, 'client_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID de Cliente inválido.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    }

    try {
        $stmt = $pdo->prepare('DELETE FROM clients WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Cliente deletado com sucesso.";
        } else {
            $_SESSION['error_message'] = "Cliente não encontrado.";
        }

        header('Location: /davidServices/pages/registerClients');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao Deletar Cliente: " . $e->getMessage();
        header('Location: /davidServices/pages/registerClients');
        exit;
    }
}
