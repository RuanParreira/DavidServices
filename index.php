<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="src/components/output.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <title>DavidServices</title>
</head>

<body>
  <main class="main-form">
    <form action="<?php echo 'src/backend/auth/login.php'; ?>" class="form-style" method="POST">
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
      <button type="submit" class="btn-login">Entrar</button>
    </form>
    </div>
  </main>
  <script src="src/scripts/form.js"></script>
</body>

</html>