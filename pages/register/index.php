<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo '../../src/backend/register.php'; ?>" method="POST">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required maxlength="100">

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required minlength="8">

        <button type="submit">Registrar</button>
    </form>
</body>

</html>