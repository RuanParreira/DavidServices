<?php
require __DIR__ . '/../conn.php';

//Total de Serviços Não Começou
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_nComecou 
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 1, PDO::PARAM_INT);
    $stmt->execute();
    $total_nComecou = $stmt->fetch(PDO::FETCH_ASSOC)['total_nComecou'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Listar Serviços que Não Começou
try {
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.equipment, s.date, s.problem, c.name, c.cpf_cnpj, c.number FROM services s JOIN
    clients c ON s.id_client = c.id WHERE s.status = :status ORDER BY s.id DESC');
    $stmt->bindValue(':status', 1, PDO::PARAM_INT);
    $stmt->execute();
    $list_nComecou = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Serviços: " . $e->getMessage();
}

//-----------------------------------------------------------------------------------------------------

//Total de Serviços Iniciados
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_iniciados
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 2, PDO::PARAM_INT);
    $stmt->execute();
    $total_iniciados = $stmt->fetch(PDO::FETCH_ASSOC)['total_iniciados'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Listar Serviços Iniciados
try {
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.equipment, s.observation, s.date, s.problem, c.name, c.cpf_cnpj, c.number FROM services s JOIN
    clients c ON s.id_client = c.id WHERE s.status = :status ORDER BY s.id DESC');
    $stmt->bindValue(':status', 2, PDO::PARAM_INT);
    $stmt->execute();
    $list_iniciados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Serviços: " . $e->getMessage();
}

//-----------------------------------------------------------------------------------------------------

//Total de Serviços Prontos
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_prontos
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 3, PDO::PARAM_INT);
    $stmt->execute();
    $total_prontos = $stmt->fetch(PDO::FETCH_ASSOC)['total_prontos'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Listar Serviços Prontos
try {
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.equipment, s.date, s.problem, c.name, c.cpf_cnpj, c.number FROM services s JOIN
    clients c ON s.id_client = c.id WHERE s.status = :status ORDER BY s.id DESC');
    $stmt->bindValue(':status', 3, PDO::PARAM_INT);
    $stmt->execute();
    $list_prontos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Serviços: " . $e->getMessage();
}

//-----------------------------------------------------------------------------------------------------

//Total de Serviços finalizados
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total_finalizados
    FROM services WHERE status = :status");
    $stmt->bindValue(':status', 4, PDO::PARAM_INT);
    $stmt->execute();
    $total_finalizados = $stmt->fetch(PDO::FETCH_ASSOC)['total_finalizados'];
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Listar Serviços Finalizados
try {
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.equipment, s.date, s.problem, c.name, c.cpf_cnpj, c.number FROM services s JOIN
    clients c ON s.id_client = c.id WHERE s.status = :status ORDER BY s.id DESC');
    $stmt->bindValue(':status', 4, PDO::PARAM_INT);
    $stmt->execute();
    $list_finalizados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Serviços: " . $e->getMessage();
}
//-----------------------------------------------------------------------------------------------------
