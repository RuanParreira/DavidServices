<?php
require __DIR__ . '/../conn.php';

// Função para extrair apenas o primeiro nome
function getFirstName($fullName)
{
    if (empty($fullName)) {
        return '';
    }

    $names = explode(' ', trim($fullName));
    return $names[0];
}

// Buscar Técnicos Registrados com Filtro
try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    if ($search !== '') {
        $stmt = $pdo->prepare('SELECT id, name, cpf, number FROM technicians WHERE name LIKE :search OR cpf LIKE :search ORDER BY created_at DESC');
        $stmt->execute([':search' => '%' . $search . '%']);
    } else {
        $stmt = $pdo->prepare('SELECT id, name, cpf, number FROM technicians ORDER BY created_at DESC');
        $stmt->execute();
    }
    $resultTechnicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Técnico: ";
    header('Location: /davidServices/pages/registertechnicians');
    exit;
}
