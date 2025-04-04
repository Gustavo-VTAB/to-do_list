<?php

    require_once('./database/conn.php');    
    session_start(); // Inicia a sessão para verificar se o usuário está logado

    if(empty($_SESSION['user'])){ // Verifica se o usuário está logado
        header('Location: ./index.php'); // Se não estiver, redireciona para a página de login
        exit;
    }

    $tasks = [];

    $sql = $pdo->query("SELECT * FROM task ORDER BY id ASC"); // Seleciona todas as tarefas do banco de dados

    // Verificando se existem tarefas cadastradas
    if($sql->rowCount() > 0){ 
        $tasks = $sql->fetchAll(PDO::FETCH_ASSOC); // Se sim, armazena as tarefas em um array
        //var_dump($tasks);
    }
     
?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/styles/style.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>listador de tarefas</title>
</head>
<body>
    <div id="to_do">

    <h1>Lista de tarefas, Olá <?= htmlspecialchars($_SESSION['user'] ?? 'Usuário') ?></h1>


        <div class="filters">
        <select id="filter-status">
            <option value="">Todos os status</option>
            <option value="0">Pendente</option>
            <option value="1">Em andamento</option>
            <option value="2">Concluída</option>
        </select>

        <select id="filter-date">
            <option value="">Ordenar por data</option>
            <option value="asc">Mais antigas</option>
            <option value="desc">Mais novas</option>
        </select>


        </div>

        <form action="./actions/create.php" method="POST" >
            <div class="to-do-form">

                <input type="text" name="description" placeholder="Escreva sua tarefa aqui" required>
                
                <button type="submit" class="form-button">
                    <i class="fa-solid fa-plus"></i> <!-- Uso do  font-awesome para pegar o icone '+'-->
                </button>
                
            </div>
            <div class="to-do-form2">
                <select name="status" id="">
                    <option value="0">Pendente</option>
                    <option value="1">Em andamento</option>
                    <option value="2">Concluída</option>
                </select>
            
                
                <input type="date" name="date_limit" required>
            </div>
        </form>

        <div id="tasks">
            <?php foreach($tasks as $task): ?>
                <div class="task"
                data-status="<?= $task['status'] ?>" 
                data-date="<?= $task['date_limit'] ?>">

                    <input 
                        type="checkbox" 
                        name="progress" 
                        class="progress <?= $task['completed']  ? 'done' : ''?>"
                        data-task-id="<?= $task['id'] ?>"
                        <?= $task['completed'] ? 'checked' : '' ?>
                    >
                
                    <p class="task-description">
                        <?= $task['description'] ?>
                    </p>

                    <p class="task-status" <?= $task['status'] == 0 ? 'pending' : ($task['status'] == 1 ? 'in-progress' : 'done') ?>>
                        <?= $task['status'] == 0 ? 'Pendente' : ($task['status'] == 1 ? 'Em andamento' : 'Concluida') ?>
                    </p>

                    <p class="task-date">
                        <?= date('d/m/Y', strtotime($task['date_limit'])) ?>
                    </p>
                    <div class="task-actions">
                        <a  class="action-button edit-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <a href="./actions/delete.php?id=<?= $task['id'] ?>" class="action-button delete-button">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>

                    <form action="./actions/update.php" method="POST" class="to-do-form edit-task hidden">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">

                        <input 
                            type="text" 
                            name="description" 
                            placeholder="Edite sua tarefa aqui" 
                            value="<?=  $task['description'] ?>"
                        >

                        <button type="submit" class="form-button confirm-button">
                            <i class="fa-solid fa-check"></i>   <!-- Uso do  font-awesome para pegar o icone 'check'-->
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>


    </div>


                
    <script src="src/javascript/script.js"></script>
</body>
</html>

