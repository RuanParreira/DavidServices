<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['client_id'] ?? null;
    $name = trim(strip_tags($_POST['edit_name'] ?? ''));
    $number = trim(strip_tags(preg_replace('/\D/', '', $_POST['edit_number'] ?? ''))); // Remove tudo que não for número

    // Verifica o id do Cliente
    $id = filter_input(INPUT_POST, 'client_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID de Cliente inválido.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    }


    // Verificar se todos os campos estão preenchidos
    if (empty($name) || empty($number) || empty($id)) {
        $_SESSION['error_message'] = "Todos os campos são obrigatórios.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    }

    //Verifica o Nome do Cliente
    if (strlen($name) > 100) {
        $_SESSION['error_message'] = "O nome não pode exceder 100 caracteres.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    } elseif (!preg_match('/^[\p{L} ]+$/u', $name)) {
        $_SESSION['error_message'] = "O nome deve conter apenas letras e espaços.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    }

    //Verificar Contato
    if (strlen($number) !== 10 && strlen($number) !== 11) {
        $_SESSION['error_message'] = "Número de contato inválido.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    } elseif (!preg_match('/^\d{1,11}$/', $number)) {
        $_SESSION['error_message'] = "Número de contato inválido.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    }

    try {
        $stmt = $pdo->prepare('UPDATE clients SET name = :name, number = :number WHERE id = :id');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':number', $number, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Cliente atualizado com sucesso.";
        } else {
            $_SESSION['error_message'] = "Nenhuma alteração feita ou Cliente não encontrado.";
        }
        header('Location: /davidServices/pages/registerClients');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao Atualizar Cliente: " . $e->getMessage();
        header('Location: /davidServices/pages/registerClients');
        exit;
    }
}
