<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

//Buscar Clients Registrados com Filtro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $id_client = $_POST['id_client'] ?? null;
    $id_technical = $_POST['id_technical'] ?? null;
    $equipment = trim(strip_tags($_POST['equipment'] ?? ''));
    $problem = trim(strip_tags($_POST['problem'] ?? ''));
    $date = trim(strip_tags($_POST['date'] ?? ''));

    if (empty($user_id) || empty($id_technical) || empty($id_client) || empty($equipment) || empty($problem) || empty($date)) {
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
        $stmt = $pdo->prepare('INSERT INTO services (id_user, id_client,  id_technical, equipment, problem, date) VALUES (:id_u, :id_c, :id_tec, :eq, :p, :d)');
        $stmt->bindValue(':id_u', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':id_c', $id_client, PDO::PARAM_INT);
        $stmt->bindValue(':id_tec', $id_technical, PDO::PARAM_INT);
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
