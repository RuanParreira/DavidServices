<?php
require __DIR__ . '/../conn.php';
session_start();

// Remove apenas o token deste dispositivo
if (!empty($_COOKIE['remember_token'])) {
    $tokenHash = hash('sha256', $_COOKIE['remember_token']);
    $stmt = $pdo->prepare("DELETE FROM user_remember_tokens WHERE token_hash = :token_hash");
    $stmt->execute([':token_hash' => $tokenHash]);
}

// Apaga cookie no navegador
setcookie('remember_token', '', time() - 3600, '/');

// Encerra sessão
$_SESSION = [];
session_destroy();

header('Location: ../../../');
exit;
