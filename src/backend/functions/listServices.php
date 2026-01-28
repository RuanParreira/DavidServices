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
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.equipment, s.date, s.problem, c.name, c.cpf_cnpj, c.number, t.id AS technician_id, t.name AS technician_name 
    FROM services s 
    JOIN clients c ON s.id_client = c.id 
    JOIN technicians t ON s.id_technical = t.id
    WHERE s.status = :status ORDER BY s.id DESC');
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
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.equipment, s.observation, s.date, s.problem, c.name, c.cpf_cnpj, c.number, t.id AS technician_id, t.name AS technician_name 
    FROM services s 
    JOIN clients c ON s.id_client = c.id 
    JOIN technicians t ON s.id_technical = t.id 
    WHERE s.status = :status ORDER BY s.id DESC');
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
    $stmt = $pdo->prepare('SELECT s.id, s.status, s.equipment, s.observation, s.date, s.problem, c.name, c.cpf_cnpj, c.number, t.id AS technician_id, t.name AS technician_name 
    FROM services s 
    JOIN clients c ON s.id_client = c.id 
    JOIN technicians t ON s.id_technical = t.id 
    WHERE s.status = :status ORDER BY s.id DESC');
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


//Lista de Serviços Finalizados com Filtro
try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $dataChegada = isset($_GET['dataChegada']) ? $_GET['dataChegada'] : '';
    $dataEntregue = isset($_GET['dataEntregue']) ? $_GET['dataEntregue'] : '';

    // Remover tudo que não for dígito para busca por CPF/CNPJ sem pontuação
    $cleanSearch = preg_replace('/\D/', '', $search);

    $sql = 'SELECT s.id, s.status, s.equipment, s.observation, s.date, s.updated_at, s.problem, c.name, c.cpf_cnpj, c.number, t.id AS technician_id, t.name AS technician_name 
            FROM services s 
            JOIN clients c ON s.id_client = c.id 
            JOIN technicians t ON s.id_technical = t.id 
            WHERE s.status = :status';
    $params = [':status' => 4];

    if ($search !== '') {
        // Busca por nome, equipamento, cpf_cnpj (com e sem pontuação)
        $sql .= " AND (c.name LIKE :search OR s.equipment LIKE :search";
        $params[':search'] = "%$search%";

        if ($cleanSearch !== '') {
            // compara a versão sem pontuação do cpf_cnpj (MySQL REPLACE em cadeia)
            $sql .= " OR REPLACE(REPLACE(REPLACE(REPLACE(c.cpf_cnpj, '.', ''), '-', ''), '/', ''), ' ', '') LIKE :cleanSearch";
            $params[':cleanSearch'] = "%$cleanSearch%";
        } else {
            // caso o usuário pesquise incluindo pontuação, também verifica a coluna original
            $sql .= " OR c.cpf_cnpj LIKE :search";
        }

        $sql .= ")";
    }

    if ($dataChegada !== '') {
        $sql .= ' AND s.date = :dataChegada';
        $params[':dataChegada'] = $dataChegada;
    }

    if ($dataEntregue !== '') {
        // aceitar formato dd/mm/yyyy ou yyyy-mm-dd
        if (strpos($dataEntregue, '/') !== false) {
            $dt = DateTime::createFromFormat('d/m/Y', $dataEntregue);
            $dataEntregue = $dt ? $dt->format('Y-m-d') : $dataEntregue;
        }
        // comparar apenas a parte data de updated_at
        $sql .= ' AND DATE(s.updated_at) = :dataEntregue';
        $params[':dataEntregue'] = $dataEntregue;
    }

    $sql .= ' ORDER BY s.id DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $list_finalizados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erro ao Buscar Serviços: " . $e->getMessage();
    header('Location: ../../../pages/registerClients');
    exit;
}

//-------------------------------------------------------------------------------

// Buscar Técnicos para o Modal de Edição
try {
    $stmt = $pdo->prepare('SELECT id, name FROM technicians ORDER BY name ASC');
    $stmt->execute();
    $allTechnicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao Buscar Técnicos: " . $e->getMessage();
}
