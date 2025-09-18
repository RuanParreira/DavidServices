<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

//Validar CPF
function validarCPF($cpf)
{
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) return false;
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) return false;
    }
    return true;
}

// Registrar Técnicos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(strip_tags($_POST['name'] ?? ''));
    $cpf = trim(strip_tags(preg_replace('/\D/', '', $_POST['cpf'] ?? ''))); // Remove tudo que não for número
    $number = trim(strip_tags(preg_replace('/\D/', '', $_POST['number'] ?? ''))); // Remove tudo que não for número
    $id_user = $_SESSION['user_id'] ?? null;

    // Verificar se todos os campos estão preenchidos
    if (empty($name) || empty($cpf) || empty($number) || empty($id_user)) {
        $_SESSION['error_message'] = "Todos os campos são obrigatórios.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }

    //Verifica o Nome do Técnico
    if (strlen($name) > 100) {
        $_SESSION['error_message'] = "O nome não pode exceder 100 caracteres.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    } elseif (!preg_match('/^[\p{L} ]+$/u', $name)) {
        $_SESSION['error_message'] = "O nome deve conter apenas letras e espaços.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }

    // Chama a função para validar CPF
    if (!(validarCPF($cpf))) {
        $_SESSION['error_message'] = "CPF inválido.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }

    //Verificar Contato
    if (strlen($number) !== 10 && strlen($number) !== 11) {
        $_SESSION['error_message'] = "Número de contato inválido.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    } elseif (!preg_match('/^\d{1,11}$/', $number)) {
        $_SESSION['error_message'] = "Número de contato inválido.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }

    //Verifica se o CPF
    $stmt = $pdo->prepare('SELECT id FROM technicians WHERE cpf = :cp');
    $stmt->bindValue(':cp', $cpf, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->fetch()) {
        $_SESSION['error_message'] = "Esse CPF já está cadastrado.";
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }

    try {
        $stmt = $pdo->prepare('INSERT INTO technicians (name, cpf, number, id_user) VALUES (:n, :cp, :nu, :i)');
        $stmt->bindValue(':n', $name, PDO::PARAM_STR);
        $stmt->bindValue(':cp', $cpf, PDO::PARAM_STR);
        $stmt->bindValue(':nu', $number, PDO::PARAM_STR);
        $stmt->bindValue(':i', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success_message'] = 'Técnico cadastrado com sucesso!';
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['error_message'] = 'Erro ao cadastrar Técnico.';
        header('Location: /davidServices/pages/registerTechnicians');
        exit;
    }
}
