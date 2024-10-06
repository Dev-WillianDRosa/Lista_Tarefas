<?php
include('conexao.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tarefa'])) {
        $tarefa = $mysqli->real_escape_string($_POST['tarefa']);
        $idUsuario = $_SESSION['id'];

        $queryado = "INSERT INTO tarefas (id_usuario, tarefa, status) 
                     VALUES ('$idUsuario', '$tarefa', 'pendente')";
        if ($mysqli->query($queryado)) {
            echo 'Tarefa cadastrada com sucesso!';
        } else {
            echo 'Erro ao cadastrar tarefa: ' . $mysqli->error;
    }
    } else {
        echo 'Por favor, preencha o campo da tarefa.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Tarefa!</title>
         <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .voltar {
            text-align: center;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="tarefa">Nova Tarefa:
            <input type="text" name="tarefa" id="tarefa" required>
        </label>
        <button type="submit">Gravar</button>
    </form>

    <div>
        <a href="painel.php">Voltar</a>
    </div>
</body>
</html>
