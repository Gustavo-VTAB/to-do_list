<?php
    require_once('../database/conn.php');

    $id = filter_input(INPUT_GET, 'id'); // Pega o id da tarefa a ser deletada
    if($id){
        $sql = $pdo->prepare("DELETE FROM task WHERE id = :id"); // Prepara a query para deletar a tarefa no banco de dados
        $sql->bindValue(':id', $id); 
        $sql->execute();
        header('Location: ../list-tarefas.php');
    } else {
        header('Location: ../list-tarefas.php');
    }




?>
