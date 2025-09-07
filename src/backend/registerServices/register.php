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

    if ($id_client && $equipment && $problem && $date) {
        try {
            $stmt = $pdo->prepare('INSERT INTO services (id_client, id_user, equipment, problem, date) VALUES (:id_client, :id_user, :eq, :p, :d)');
            $stmt->bindValue(':id_client', $id_client, PDO::PARAM_INT);
            $stmt->bindValue(':id_user', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':eq', $equipment, PDO::PARAM_STR);
            $stmt->bindValue(':p', $problem, PDO::PARAM_STR);
            $stmt->bindValue(':d', $date, PDO::PARAM_STR);
            $stmt->execute();
            echo 'Serviço registrado com sucesso!';
        } catch (PDOException $e) {
            error_log($e->getMessage());
            die('Erro ao registrar serviço: ' . $e->getMessage());
        }
    } else {
        echo 'Preencha todos os campos obrigatórios!';
    }
}
