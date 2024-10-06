<?php
include('conexao.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$idUsuario = $_SESSION['id'];
$queryado = "SELECT id, tarefa, status FROM tarefas WHERE id_usuario = $idUsuario";
$result = $mysqli->query($queryado) or die($mysqli->error);

$tarefas = [];
while ($row = $result->fetch_assoc()) {
    $tarefas[] = $row;
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        border: 1px solid #dee2e6;
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    tr:hover {
        background-color: #f1f1f1;
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

    a {
        text-decoration: none;
    }
    </style>
</head>
<body>
    <h2>Minhas Tarefas</h2>
    <table>
        <thead>
            <tr>
                <th>Tarefa</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tarefas as $tarefa): ?>
            <tr>
                <td><?php echo $tarefa['tarefa']; ?></td>
                <td><?php echo $tarefa['status']; ?></td>
                <td>
                    <form action="marcar_concluida.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                        <button type="submit">Marcar como Concluída</button>
                    </form>

                    <form action="deletar_tarefa.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <a href="cadastrar_tarefa.php"><button>Cadastrar Nova Tarefa</button></a>
    </div>
</body>
</html>
