<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['menuState'])) {
        $_SESSION['menuState'] = $input['menuState'];

        http_response_code(200);
        echo json_encode(['success' => true, 'menuState' => $_SESSION['menuState']]);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Estado do menu não fornecido']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método não permitido']);
}
