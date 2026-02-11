<?php
require __DIR__ . '/../conn.php';

try {
    // Diferenciar entre: parâmetro ausente (mostrar visitas do dia),
    // parâmetro presente mas vazio (mostrar todas), ou data específica.
    $search = isset($_GET['search']) ? trim($_GET['search']) : null;
    if (!isset($_GET['search'])) {
        // Parâmetro não enviado: mostrar visitas do dia
        $today = date('Y-m-d');
        $stmt = $pdo->prepare('SELECT s.id, s.status, s.date, s.time, s.address, s.id_technical, c.name, c.number, t.name as technical_name
        FROM visits s 
        JOIN clients c ON s.id_client = c.id
        JOIN technicians t ON s.id_technical = t.id
        WHERE s.date = :search
        ORDER BY s.time ASC');
        $stmt->execute([':search' => $today]);
    } elseif ($search === '') {
        // Parâmetro presente mas vazio: mostrar todas as visitas
        $stmt = $pdo->prepare('SELECT s.id, s.status, s.date, s.time, s.address, s.id_technical, c.name, c.number, t.name as technical_name
        FROM visits s 
        JOIN clients c ON s.id_client = c.id
        JOIN technicians t ON s.id_technical = t.id
        ORDER BY s.date ASC, s.time ASC');
        $stmt->execute();
    } else {
        // Busca por data exata passada no parâmetro
        $stmt = $pdo->prepare('SELECT s.id, s.status, s.date, s.time, s.address, s.id_technical, c.name, c.number, t.name as technical_name
        FROM visits s 
        JOIN clients c ON s.id_client = c.id
        JOIN technicians t ON s.id_technical = t.id
        WHERE s.date = :search
        ORDER BY s.time ASC');
        $stmt->execute([':search' => $search]);
    }
    $list_Visits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Visitas: " . $e->getMessage();
}

// Verifica visita agendada
$dataSelecionada = $_POST['date'] ?? date('Y-m-d');

try {
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.date, s.time, s.address, c.name, c.number
        FROM visits s
        JOIN clients c ON s.id_client = c.id
        WHERE s.status = 1 AND s.date = ?
        ORDER BY s.time DESC');
    $stmt->execute([$dataSelecionada]);
    $agendado = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Visitas: " . $e->getMessage();
}

// Buscar Técnicos Registrados

try {
    $stmt = $pdo->prepare('SELECT id, name, cpf, number FROM technicians ORDER BY created_at DESC');
    $stmt->execute();
    $resultTechnicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Técnico: ";
    header('Location: ../../../pages/visits');
    exit;
}
