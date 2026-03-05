<?php
require __DIR__ . '/config/config.php';

try {
    $pdo = new PDO(
        'mysql:host=' . CONF_DB_HOST . ';dbname=' . CONF_DB_NAME,
        CONF_DB_USER,
        CONF_DB_PASS,
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . CONF_DB_CHARSET
        ]
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die('Erro ao conectar ao banco de dados.');
}

function checkRememberToken($pdo)
{
    if (empty($_COOKIE['remember_token'])) {
        return false;
    }

    $tokenHash = hash('sha256', $_COOKIE['remember_token']);

    $stmt = $pdo->prepare("
        SELECT id, user_id, expires_at
        FROM user_remember_tokens
        WHERE token_hash = :token_hash
        LIMIT 1
    ");
    $stmt->execute([':token_hash' => $tokenHash]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return false;
    }

    if (strtotime($row['expires_at']) < time()) {
        $del = $pdo->prepare("DELETE FROM user_remember_tokens WHERE id = :id");
        $del->execute([':id' => $row['id']]);
        setcookie('remember_token', '', time() - 3600, '/');
        return false;
    }

    $_SESSION['user_id'] = (int)$row['user_id'];

    $upd = $pdo->prepare("UPDATE user_remember_tokens SET last_used_at = NOW() WHERE id = :id");
    $upd->execute([':id' => $row['id']]);

    return true;
}
