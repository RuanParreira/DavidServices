<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

//Buscar Clients Registrados com Filtro
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_SESSION['user_id'] ?? null;
    $id_client = $_GET['id_client'] ?? null;
    $equipment = trim(strip_tags($_GET['equipment'] ?? ''));
    $problem = trim(strip_tags($_GET['problem'] ?? ''));
    $date = trim(strip_tags($_GET['date'] ?? ''));

    if (empty($user_id) || empty($id_client) || empty($equipment) || empty($problem) || empty($date)) {
        $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
        header('Location: ../../../pages/registerServices');
        exit;
    }

    if (strlen($equipment) > 100) {
        $_SESSION['error_message'] = 'O equipamento deve ter no máximo 100 caracteres.';
        header('Location: ../../../pages/registerServices');
        exit;
    }

    if (strlen($problem) > 255) {
        $_SESSION['error_message'] = 'O problema descrito deve ter no máximo 255 caracteres.';
        header('Location: ../../../pages/registerServices');
        exit;
    }

    try {
        $stmt = $pdo->prepare('INSERT INTO services (id_client, id_user, equipment, problem, date) VALUES (:id_client, :id_user, :eq, :p, :d)');
        $stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':eq', $equipment, PDO::PARAM_STR);
        $stmt->bindValue(':p', $problem, PDO::PARAM_STR);
        $stmt->bindValue(':d', $date, PDO::PARAM_STR);
        $stmt->execute();
        $_SESSION['success_message'] = 'Serviço registrado com sucesso.';
        header('Location: ../../../pages/registerServices');
        exit;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['error_message'] = 'Erro ao registrar serviço: ' . $e->getMessage();
        header('Location: ../../../pages/registerServices');
        exit;
    }
}
