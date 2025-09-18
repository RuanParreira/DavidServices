<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

// Buscar Clientes Registrados com Filtro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $id_client = $_POST['id_client'] ?? null;
    $id_technical = $_POST['id_technical'] ?? null;
    $date = trim(strip_tags($_POST['date'] ?? ''));
    $time = trim(strip_tags($_POST['time'] ?? ''));
    $address = trim(strip_tags($_POST['address'] ?? ''));

    if (empty($user_id) || empty($id_client) || empty($id_technical) || empty($date) || empty($time) || empty($address)) {
        $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
        header('Location: ../../../pages/visits');
        exit;
    }

    if (strlen($address) > 255) {
        $_SESSION['error_message'] = 'O endereço deve ter no máximo 255 caracteres.';
        header('Location: ../../../pages/visits');
        exit;
    }

    if (!in_array($time, ['09:00', '09:30', '10:00', '10:30', '14:30', '15:00', '15:30', '16:00'])) {
        $_SESSION['error_message'] = 'Horário inválido. Escolha um horário válido.';
        header('Location: ../../../pages/visits');
        exit;
    }

    if ($date < date('Y-m-d')) {
        $_SESSION['error_message'] = 'A data da visita não pode ser no passado.';
        header('Location: ../../../pages/visits');
        exit;
    }

    $stmt = $pdo->prepare('SELECT id FROM visits WHERE status = :status AND date = :date AND time = :time');
    $stmt->bindValue(':status', 1, PDO::PARAM_INT);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':time', $time, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->fetch()) {
        $_SESSION['error_message'] = 'Você tem uma visita pendente para este horário.';
        header('Location: ../../../pages/visits');
        exit;
    }

    try {
        $stmt = $pdo->prepare('INSERT INTO visits (id_client, id_user, id_technical, date, time, address) VALUES (:id_client, :id_user, :id_technical, :d, :t, :a)');
        $stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':id_technical', $id_technical, PDO::PARAM_INT);
        $stmt->bindValue(':d', $date, PDO::PARAM_STR);
        $stmt->bindValue(':t', $time, PDO::PARAM_STR);
        $stmt->bindValue(':a', $address, PDO::PARAM_STR);
        $stmt->execute();
        $_SESSION['success_message'] = 'Visita agendada com sucesso.';
        header('Location: ../../../pages/visits');
        exit;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['error_message'] = 'Erro ao agendar visita: ' . $e->getMessage();
        header('Location: ../../../pages/visits');
        exit;
    }
}
