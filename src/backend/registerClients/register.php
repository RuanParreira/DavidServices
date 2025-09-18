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

// Validar CNPJ
function validarCNPJ($cnpj)
{
    if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) return false;
    $t = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for ($i = 0, $s = 0; $i < 12; $i++) $s += $cnpj[$i] * $t[$i];
    $r = $s % 11;
    if ($cnpj[12] != ($r < 2 ? 0 : 11 - $r)) return false;
    $t = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    for ($i = 0, $s = 0; $i < 13; $i++) $s += $cnpj[$i] * $t[$i];
    $r = $s % 11;
    if ($cnpj[13] != ($r < 2 ? 0 : 11 - $r)) return false;
    return true;
}


// Registrar Clientes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(strip_tags($_POST['name'] ?? ''));
    $cpf_cnpj = trim(strip_tags(preg_replace('/\D/', '', $_POST['cpf_cnpj'] ?? ''))); // Remove tudo que não for número
    $number = trim(strip_tags(preg_replace('/\D/', '', $_POST['number'] ?? ''))); // Remove tudo que não for número
    $id_user = $_SESSION['user_id'] ?? null;

    // Verificar se todos os campos estão preenchidos
    if (empty($name) || empty($cpf_cnpj) || empty($number) || empty($id_user)) {
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

    // Chama a função para validar CPF/CNPJ
    if (!(validarCPF($cpf_cnpj) || validarCNPJ($cpf_cnpj))) {
        $_SESSION['error_message'] = "CPF/CNPJ inválido.";
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

    //Verifica se o CPF/CNPJ já existe no banco de dados
    $stmt = $pdo->prepare('SELECT id FROM clients WHERE cpf_cnpj = :cp');
    $stmt->bindValue(':cp', $cpf_cnpj, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->fetch()) {
        $_SESSION['error_message'] = "Esse CPF/CNPJ já está cadastrado.";
        header('Location: /davidServices/pages/registerClients');
        exit;
    }

    try {
        $stmt = $pdo->prepare('INSERT INTO clients (name, cpf_cnpj, number, id_user) VALUES (:n, :cp, :nu, :i)');
        $stmt->bindValue(':n', $name, PDO::PARAM_STR);
        $stmt->bindValue(':cp', $cpf_cnpj, PDO::PARAM_STR);
        $stmt->bindValue(':nu', $number, PDO::PARAM_STR);
        $stmt->bindValue(':i', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['success_message'] = 'Cliente cadastrado com sucesso!';
        header('Location: /davidServices/pages/registerClients');
        exit;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['error_message'] = 'Erro ao cadastrar cliente.';
        header('Location: /davidServices/pages/registerClients');
        exit;
    }
}
