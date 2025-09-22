<?php
require __DIR__ . '/../conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email =  strtolower(trim($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $password = trim($_POST['password'] ?? '');

    if (!$email || !$password) {
        echo 'Dados inválidos.';
        exit;
    }

    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['welcome_message'] = 'Bem-vindo ao DavidServices!';
        header('Location: ../../../pages/dashBoard');
    } else {
        $_SESSION['error_message'] = "Email ou Senha Invalidos!";
        header('Location: /davidServices');
    }
}
