<?php
    $hostname = "127.0.0.1";
    $user = "root";
    $password = "root";
    $database = "gestao_tarefas";

    $mysqli = new mysqli($hostname, $user, $password, $database);

    if($mysqli->connect_error){
        die("Falhou a conexão: " . $mysqli->connect_error);
    }
?>
