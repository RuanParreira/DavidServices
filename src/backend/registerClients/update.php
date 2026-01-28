<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/../functions/geral.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['client_id'] ?? null;
    $name = trim(strip_tags($_POST['edit_name'] ?? ''));
    $number = trim(strip_tags(preg_replace('/\D/', '', $_POST['edit_number'] ?? ''))); // Remove tudo que não for número

    // Novo: captura e normaliza cpf_cnpj (opcional)
    $cpf_cnpj = trim(strip_tags(preg_replace('/\D/', '', $_POST['edit_cpf_cnpj'] ?? '')));
    $cpf_cnpj = ($cpf_cnpj === '') ? null : $cpf_cnpj;

    // Verifica o id do Cliente
    $id = filter_input(INPUT_POST, 'client_id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id <= 0) {
        $_SESSION['error_message'] = "ID de Cliente inválido.";
        header('Location: ../../../pages/registerClients');
        exit;
    }


    // Verificar se todos os campos estão preenchidos
    if (empty($name) || empty($number) || empty($id)) {
        $_SESSION['error_message'] = "Todos os campos são obrigatórios.";
        header('Location: ../../../pages/registerClients');
        exit;
    }

    //Verifica o Nome do Cliente
    if (strlen($name) > 100) {
        $_SESSION['error_message'] = "O nome não pode exceder 100 caracteres.";
        header('Location: ../../../pages/registerClients');
        exit;
    } elseif (!preg_match('/^[\p{L} ]+$/u', $name)) {
        $_SESSION['error_message'] = "O nome deve conter apenas letras e espaços.";
        header('Location: ../../../pages/registerClients');
        exit;
    }

    // Chama a função para validar CPF/CNPJ (se informado)
    if ($cpf_cnpj !== null && !(validarCPF($cpf_cnpj) || validarCNPJ($cpf_cnpj))) {
        $_SESSION['error_message'] = "CPF/CNPJ inválido.";
        header('Location: ../../../pages/registerClients');
        exit;
    }

    //Verificar Contato
    if (strlen($number) !== 10 && strlen($number) !== 11) {
        $_SESSION['error_message'] = "Número de contato inválido.";
        header('Location: ../../../pages/registerClients');
        exit;
    } elseif (!preg_match('/^\d{1,11}$/', $number)) {
        $_SESSION['error_message'] = "Número de contato inválido.";
        header('Location: ../../../pages/registerClients');
        exit;
    }

    // Verifica se o CPF/CNPJ já existe no banco de dados (apenas se informado), ignorando o próprio cliente
    if ($cpf_cnpj !== null) {
        $stmt = $pdo->prepare('SELECT id FROM clients WHERE cpf_cnpj = :cp AND id != :id');
        $stmt->bindValue(':cp', $cpf_cnpj, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->fetch()) {
            $_SESSION['error_message'] = "Esse CPF/CNPJ já está cadastrado para outro cliente.";
            header('Location: ../../../pages/registerClients');
            exit;
        }
    }

    try {
        $stmt = $pdo->prepare('UPDATE clients SET name = :name, number = :number, cpf_cnpj = :cpf_cnpj WHERE id = :id');
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':number', $number, PDO::PARAM_STR);
        if ($cpf_cnpj === null) {
            $stmt->bindValue(':cpf_cnpj', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);
        }
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Cliente atualizado com sucesso.";
        } else {
            $_SESSION['error_message'] = "Nenhuma alteração feita ou Cliente não encontrado.";
        }
        header('Location: ../../../pages/registerClients');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Erro ao Atualizar Cliente: " . $e->getMessage();
        header('Location: ../../../pages/registerClients');
        exit;
    }
}
