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
