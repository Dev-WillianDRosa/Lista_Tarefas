<?php
include('conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['user']) || empty($_POST['senha'])) {
        echo 'Por favor, preencha os campos necessários.';
    } else {
        $user = $mysqli->real_escape_string($_POST['user']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $queryado = "SELECT * FROM usuarios WHERE user = '$user' AND senha = '$senha'";
        $sql2 = $mysqli->query($queryado) or die("Falha no SQL: " . $mysqli->error);
        $quantidade = $sql2->num_rows;

        if ($quantidade == 1) {
            $usuario = $sql2->fetch_assoc();

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header('location: painel.php');
            exit();
        } else {
            echo 'Email ou Senha estão incorretos';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Sistema</title>
</head>
<body>
    <form action="login.php" method="POST" autocomplete="off">

    <label for="user">Usuário:
    <input type="text" name="user" id="user" maxlength="20" autocomplete="user" autofocus required> <!-- Adicionei 'required' -->
    </label>

    <label for="senha">Senha:
        <input type="password" name="senha" id="senha" maxlength="10" autocomplete="current-password" required> <!-- Mudado para 'password' e adicionei 'required' -->
    </label>

    <button type="submit">Login</button>
    </form>
</body>
</html>
