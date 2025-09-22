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
    $id = strip_tags($_POST['service_id']) ?? null;
    $equipment = trim(strip_tags($_POST['edit_equipment'])) ?? null;
    $technician_id = strip_tags($_POST['technician_id']) ?? null;
    $date = strip_tags($_POST['edit_date']) ?? null;
    $edit_status = trim(strip_tags($_POST['edit_status'])) ?? null;
    $problem = trim(strip_tags($_POST['edit_problem'])) ?? null;

    // Verifica o id do serviço
    $id = filter_input(INPUT_POST, 'service_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID do Serviço inválido.";
        header('Location: ' . getRedirectUrl());
        exit;
    }

    // Verifica o id do técnico
    $technician_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);
    if ($technician_id === false || $technician_id === null || $technician_id <= 0) {
        $_SESSION['error_message'] = "ID do Técnico inválido.";
        header('Location: ' . getRedirectUrl());
        exit;
    }

    //verifica se o status é valido
    if ($edit_status != 1 && $edit_status != 2 && $edit_status != 3 && $edit_status != 4) {
        $_SESSION['error_message'] = "Status inválido.";
        header('Location: ' . getRedirectUrl());
        exit;
    }

    //verifica se o problema é valido
    if (strlen($equipment) > 100) {
        $_SESSION['error_message'] = "Permitido no maximo 100 caracteres.";
        header('Location: ' . getRedirectUrl());
        exit;
    }

    //verifica se o problema é valido
    if (strlen($problem) > 255) {
        $_SESSION['error_message'] = "Permitido no maximo 255 caracteres.";
        header('Location: ' . getRedirectUrl());
        exit;
    }

    // Verifica se todos os campos foram preenchidos
    if (empty($id) || empty($equipment) || empty($technician_id) || empty($date) || empty($edit_status) || empty($problem)) {
        echo json_encode(['error' => 'Todos os campos são obrigatórios']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE services SET equipment = :equipment, date =:date ,id_technical = :id_technical, status = :status, problem = :problem WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':equipment', $equipment);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id_technical', $technician_id);
        $stmt->bindParam(':status', $edit_status);
        $stmt->bindParam(':problem', $problem);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Serviço atualizado com sucesso!";
            header('Location: ' . getRedirectUrl());
            exit;
        } else {
            $_SESSION['error_message'] = "Nenhum serviço foi atualizado.";
            header('Location: ' . getRedirectUrl());
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao atualizar o serviço: " . $e->getMessage();
        header('Location: ' . getRedirectUrl());
        exit;
    }
}
