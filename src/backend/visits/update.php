<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['visit_id'] ?? null;
    $address = trim(strip_tags($_POST['address'])) ?? null;
    $technician_id = $_POST['technician_id'] ?? null;

    // Verifica o id da Visita
    $id = filter_input(INPUT_POST, 'visit_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID da visita inválido.";
        header('Location: /davidServices/pages/visits');
        exit;
    }

    // Verificar se todos os campos estão preenchidos
    if (empty($address) || empty($technician_id) || empty($id)) {
        $_SESSION['error_message'] = "Todos os campos são obrigatórios.";
        header('Location: /davidServices/pages/visits');
        exit;
    }

    // Verifica o endereço
    if (strlen($address) > 255) {
        $_SESSION['error_message'] = "O endereço não pode exceder 255 caracteres.";
        header('Location: /davidServices/pages/visits');
        exit;
    }

    // Verificar se o técnico existe
    $technician_id = filter_var($technician_id, FILTER_VALIDATE_INT);
    if ($technician_id === false || $technician_id <= 0) {
        $_SESSION['error_message'] = "ID do técnico inválido.";
        header('Location: /davidServices/pages/visits');
        exit;
    }

    // Verificar se o técnico existe no banco
    try {
        $stmt = $pdo->prepare('SELECT id FROM technicians WHERE id = :id');
        $stmt->bindValue(':id', $technician_id, PDO::PARAM_INT);
        $stmt->execute();
        if (!$stmt->fetch()) {
            $_SESSION['error_message'] = "Técnico não encontrado.";
            header('Location: /davidServices/pages/visits');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao verificar técnico: " . $e->getMessage();
        header('Location: /davidServices/pages/visits');
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE visits SET address = :address, id_technical = :technician_id WHERE id = :id');
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':technician_id', $technician_id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Visita atualizada com sucesso.";
        } else {
            $_SESSION['error_message'] = "Nenhuma alteração feita ou Visita não encontrada.";
        }
        header('Location: /davidServices/pages/visits');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao atualizar a visita: " . $e->getMessage();
        header('Location: /davidServices/pages/visits');
        exit;
    }
}
