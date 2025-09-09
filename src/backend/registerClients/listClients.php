<?php
require __DIR__ . '/../conn.php';

// Lista de clients Registrados 
try {
    $stmt = $pdo->prepare('SELECT name, cpf_cnpj, number FROM clients ORDER BY created_at DESC');
    $stmt->execute();
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro na conexão: ";
    header('Location: /davidServices/pages/registerClients');
    exit;
}

//Buscar Clients Registrados com Filtro
try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    if ($search !== '') {
        $stmt = $pdo->prepare('SELECT * FROM clients WHERE name LIKE
        :search OR cpf_cnpj LIKE :search ORDER BY created_at DESC');
        $stmt->execute([':search' => '%' . $search . '%']);
    } else {
        $stmt = $pdo->prepare('SELECT * FROM clients ORDER BY created_at DESC');
        $stmt->execute();
    }
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Client: ";
    header('Location: /davidServices/pages/registerClients');
    exit;
}
