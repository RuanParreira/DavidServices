<?php
require __DIR__ . '/../conn.php';

// Buscar Clients Registrados
try {
    $stmt = $pdo->prepare('SELECT id, name, cpf_cnpj, number FROM clients ORDER BY created_at DESC');
    $stmt->execute();
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Client: ";
    header('Location: /davidServices/pages/registertechnicians');
    exit;
}

// Buscar Técnicos Registrados

try {
    $stmt = $pdo->prepare('SELECT id, name, cpf, number FROM technicians ORDER BY created_at DESC');
    $stmt->execute();
    $resultTechnicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Técnico: ";
    header('Location: /davidServices/pages/registertechnicians');
    exit;
}

// Pegar o Primeiro e Segundo Nome do Técnico
function getFirstTwoNames($fullName)
{
    if (empty($fullName)) {
        return '';
    }

    $names = explode(' ', trim($fullName));

    // Se só tem um nome, retorna ele
    if (count($names) == 1) {
        return $names[0];
    }

    // Retorna primeiro e segundo nome
    return $names[0] . ' ' . $names[1];
}
