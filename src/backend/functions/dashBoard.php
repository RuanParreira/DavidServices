<?php
require __DIR__ . '/../conn.php';


// Numero de Clientes
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_clientes FROM clients");
    $stmt->execute();
    $total_clientes = $stmt->fetch(PDO::FETCH_ASSOC)['total_clientes'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}


// Numero de serviços que não começaram
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_nComecou 
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 1, PDO::PARAM_INT);
    $stmt->execute();
    $total_nComecou = $stmt->fetch(PDO::FETCH_ASSOC)['total_nComecou'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Numero de serviços em Progresso 

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_eProgresso 
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 2, PDO::PARAM_INT);
    $stmt->execute();
    $total_eProgresso = $stmt->fetch(PDO::FETCH_ASSOC)['total_eProgresso'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Numero de Serviços Prontos

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_prontos
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 3, PDO::PARAM_INT);
    $stmt->execute();
    $total_prontos = $stmt->fetch(PDO::FETCH_ASSOC)['total_prontos'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Numero de Serviços Finalizados

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_finalizados
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 4, PDO::PARAM_INT);
    $stmt->execute();
    $total_finalizados = $stmt->fetch(PDO::FETCH_ASSOC)['total_finalizados'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Numero Total de Todos os Serviços

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_servicos FROM services");
    $stmt->execute();
    $total_servicos = $stmt->fetch(PDO::FETCH_ASSOC)['total_servicos'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Os 5 servicos mais recentes
try {
    $stmt = $pdo->prepare("SELECT s.id_client, s.id, s.status, s.equipment, s.problem, s.date, s.created_at , c.name AS client_name 
    FROM services s 
    JOIN clients c ON c.id = s.id_client
    ORDER BY s.created_at DESC LIMIT 5");
    $stmt->execute();
    $ultimos_servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
