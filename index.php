<?php
require './src/backend/conn.php';
session_start();

// Se já está logado ou tem token válido, vai para dashboard
if (isset($_SESSION['user_id'])) {
  header('Location: pages/dashBoard/');
  exit;
}

// Verifica se tem cookie de "lembrar-me"
if (checkRememberToken($pdo)) {
  header('Location: pages/dashBoard/');
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="src/components/output.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="./public/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./public/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./public/favicon-16x16.png">
  <link rel="manifest" href="./site.webmanifest">
  <title>DavidServices</title>
</head>

<body>
  <!-- Mensagem de Sucesso ou Erro-->
  <?php include __DIR__ . '/src/includes/resultMessage.php'; ?>
  <main class="main-form bg-blue-200">
    <form action="./src/backend/auth/login.php" class="form-style" method="POST" autocomplete="off">
      <img src="./public/android-chrome-512x512.png" alt="logo da empresa" class="w-18 h-18 rounded-lg -mb-4" />
      <h1 class="text-blue-600 text-center p-6 text-4xl font-bold">DavidServices</h1>
      <label class="flex flex-col w-full">
        <span class="text-blue-600 font-semibold">
          Email
        </span>
        <div class="relative">
          <i class="bi bi-envelope icon-form"></i>
          <input type="email" name="email" placeholder="email" class="input-form" />
        </div>
      </label>
      <label class="flex flex-col w-full">
        <span class="text-blue-600 font-semibold">
          Senha
        </span>
        <div class="relative">
          <i class="bi bi-lock icon-form"></i>
          <input id="senhaInput" name="password" type="password" placeholder="Senha" class="input-form" />
          <button type="button" id="toggleSenha" class="eye-icon-form">
            <i id="iconEye" class="bi bi-eye"></i>
          </button>
        </div>
      </label>
      <div class="w-full flex items-center">
        <label for="remember">
          <input type="checkbox" id="remember" name="remember" class="cursor-pointer">
          <span class="text-blue-600 font-semibold text-sm">
            Lembrar-me
          </span>
        </label>
      </div>
      <button type="submit" class="btn-login">Entrar</button>
    </form>
    </div>
  </main>
  <script src="src/scripts/form.js"></script>
  <script src="src/scripts/resultMessage.js"></script>
</body>

</html>