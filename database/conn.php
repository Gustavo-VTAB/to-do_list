<?php
    
    $hostname = 'localhost';
    //$port = '9000';
    $database = 'to_do_list';
    $username = 'root';
    $password = 'admin';

    //criando a conexão com o banco de dados
    try {
        $pdo = new PDO("mysql:host=$hostname; dbname=$database", $username, $password); // Criação do objeto PDO
        
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage(); // Caso ocorra algum erro, exibe a mensagem de erro
    }
?>
