<?php
session_start(); // Inicia a sessão
require_once('../database/conn.php');


$user_id_task = $_SESSION['user_id']; // Pega o id do usuário logado
// Pega o valor do campo de descrição do formulário
$description = filter_input(INPUT_POST, 'description');
$date = filter_input(INPUT_POST, 'date_limit');
$status = filter_input(INPUT_POST, 'status'); // Pega o valor do campo de status do formulário




if($description){
    $sql = $pdo->prepare("INSERT INTO task (description, date_limit, status, user_id_task) VALUES (:description, :date_limit, :status, :user_id_task)"); // Prepara a query para adicionar a tarefa no banco de dados
    $sql->bindValue(':description', $description); //faz o bind do valor
    $sql->bindValue(':date_limit', $date); 
    $sql->bindValue(':status', $status); 
    $sql->bindValue(':user_id_task', $user_id_task); // faz o bind do id do usuário logado
    $sql->execute();
    header('Location: ../list-tarefas.php');// Redireciona para a página de tarefas
    echo 'Tarefa cadastrada com sucesso!'; // Mensagem de sucesso
} else {
    header('Location: ../list-tarefas.php');// caso não tenha descrição, redireciona para a página de tarefas
    echo 'Erro ao cadastrar tarefa!'; // Mensagem de erro
}

?>