<?php
require __DIR__ . '/../conn.php';

// Buscar Clients Registrados com Filtro
try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    if ($search !== '') {
        $stmt = $pdo->prepare('SELECT id, name, cpf_cnpj, number FROM clients WHERE name LIKE :search OR cpf_cnpj LIKE :search ORDER BY created_at DESC');
        $stmt->execute([':search' => '%' . $search . '%']);
    } else {
        $stmt = $pdo->prepare('SELECT id, name, cpf_cnpj, number FROM clients ORDER BY created_at DESC');
        $stmt->execute();
    }
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Client: ";
    header('Location: /davidServices/pages/registerClients');
    exit;
}

// Função para formatar CPF/CNPJ
function formatCpfCnpj($value): string
{
    $digits = preg_replace('/\D/', '', $value);
    if (strlen($digits) === 11) {
        // CPF
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits);
    } elseif (strlen($digits) === 14) {
        // CNPJ
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $digits);
    }
    return $value;
}

// Função para formatar número de telefone
function formatNumber($value): string
{
    $digits = preg_replace('/\D/', '', $value);
    if (strlen($digits) === 10) {
        // Formato (XX) XXXX-XXXX
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $digits);
    } elseif (strlen($digits) === 11) {
        // Formato (XX) XXXXX-XXXX
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $digits);
    }
    return $value;
}
