<?php
require __DIR__ . '/../conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password'] ?? '');
    $remember = isset($_POST['remember']); // <- faltava isso

    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "Preencha todos os campos!";
        header('Location: ../../../');
        exit;
    }

    if (!$email || !$password) {
        $_SESSION['error_message'] = "Dados inválidos!";
        header('Location: ../../../');
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

        // Token do remember
        if ($remember) {
            $rawToken = bin2hex(random_bytes(32));
            $tokenHash = hash('sha256', $rawToken);
            $expiresAt = date('Y-m-d H:i:s', time() + (30 * 24 * 60 * 60));
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;

            $stmt = $pdo->prepare("
                INSERT INTO user_remember_tokens (user_id, token_hash, expires_at, user_agent)
                VALUES (:user_id, :token_hash, :expires_at, :user_agent)
            ");
            $stmt->execute([
                ':user_id' => $user['id'],
                ':token_hash' => $tokenHash,
                ':expires_at' => $expiresAt,
                ':user_agent' => mb_substr((string)$userAgent, 0, 255),
            ]);

            setcookie('remember_token', $rawToken, [
                'expires' => time() + (30 * 24 * 60 * 60),
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
                'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            ]);
        }
        header('Location: ../../../pages/dashBoard');
    } else {
        $_SESSION['error_message'] = "Email ou Senha Invalidos!";
        header('Location: ../../../');
    }
}
