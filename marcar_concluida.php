<?php
include('conexao.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $idTarefa = intval($_POST['id']); // Converte para inteiro

        $query = "SELECT status FROM tarefas WHERE id = $idTarefa";
        $sql2 = $mysqli->query($query);

        if ($sql2->num_rows > 0) {
            $tarefa = $sql2->fetch_assoc();

            $novostatus = ($tarefa['status'] === 'pendente') ? 'concluida' : 'pendente';

            // Atualiza o status da tarefa no banco de dados
        $atualizar = "UPDATE tarefas SET status = '$novostatus' WHERE id = $idTarefa";

            if (!$mysqli->query($atualizar)) {
                echo "Erro ao atualizar: " . $mysqli->error;
            }else{
                echo "Tarefa não encontrada";
            }
            header('Location: painel.php');
        }
    }
}
?>
