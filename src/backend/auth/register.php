<?php
require __DIR__ . '/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitização e validação dos dados
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');
    $name = trim(strip_tags($_POST['name'] ?? ''));

    // Limitar tamanho do nome
    if (strlen($name) > 100) {
        die('O nome deve ter no máximo 100 caracteres.');
    }

    // Validar nome (apenas letras, espaços e acentos)
    if (!preg_match('/^[\p{L} ]+$/u', $name)) {
        die('O nome deve conter apenas letras e espaços.');
    }

    // Validar e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Email inválido.');
    }

    // Validar senha
    if (strlen($password) < 8) {
        die('A senha deve ter pelo menos 8 caracteres.');
    }

    // Verificar se o e-mail já existe
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    if ($stmt->fetch()) {
        die('Esse email já está registrado.');
    }

    $hasPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:n, :e, :p)');
        $stmt->bindValue(':n', $name, PDO::PARAM_STR);
        $stmt->bindValue(':e', $email, PDO::PARAM_STR);
        $stmt->bindValue(':p', $hasPassword, PDO::PARAM_STR);
        $stmt->execute();
        echo 'Usuário registrado com sucesso!';
    } catch (PDOException $e) {
        error_log($e->getMessage());
        // Mensagem genérica para o usuário
        die('Erro ao registrar usuário.');
    }
}
