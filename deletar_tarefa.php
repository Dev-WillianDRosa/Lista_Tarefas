<?php
include('conexao.php');
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $idTarefa = intval($_POST['id']); // Converte para inteiro

    $queryado = "DELETE FROM tarefas WHERE id = $idTarefa";

    if (!$mysqli->query($queryado)) {
        echo "Erro ao apagar: " . $mysqli->error;
    }else{
        echo "Tarefa não encontrada";
    }
    header('Location: painel.php');
    }
    }
?>