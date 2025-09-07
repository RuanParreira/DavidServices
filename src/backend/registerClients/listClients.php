<?php
require __DIR__ . '/../conn.php';

// Lista de clients Registrados 
try {
    $stmt = $pdo->prepare('SELECT name, cpf_cnpj, number FROM clients');
    $stmt->execute();
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}

//Buscar Clients Registrados com Filtro
try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    if ($search !== '') {
        $stmt = $pdo->prepare('SELECT * FROM clients WHERE name LIKE
        :search OR cpf_cnpj LIKE :search');
        $stmt->execute([':search' => '%' . $search . '%']);
    } else {
        $stmt = $pdo->prepare('SELECT * FROM clients');
        $stmt->execute();
    }
    $resultClients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Client: " . $e->getMessage();
}
