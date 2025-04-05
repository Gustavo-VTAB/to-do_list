<?php

require_once('../database/conn.php');

// Pegando o valor do campo de descrição e id do item que será editado
$description = filter_input(INPUT_POST, 'description');
$id = filter_input(INPUT_POST, 'id'); 



if($description && $id){
    $sql = $pdo->prepare("UPDATE task SET description = :description WHERE id = :id"); // Prepara a query para editar a tarefa no banco de dados
    $sql->bindValue(':description', $description); //faz o bind do valor
    $sql->bindValue(':id', $id);
    $sql->execute();
    header('Location: ../list-tarefas.php');
} else {
    header('Location: ../list-tarefas.php');
}

?>