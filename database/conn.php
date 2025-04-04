<?php

$database_url = "mysql://root:xIXsTWegyDeJQCTvBHQPJMFBWRVZLrjC@interchange.proxy.rlwy.net:59171/railway";

// Parseando a URL do banco de dados
$parsed_url = parse_url($database_url);

$hostname = $parsed_url["host"];
$port = $parsed_url["port"];
$username = $parsed_url["user"];
$password = $parsed_url["pass"];
$database = ltrim($parsed_url["path"], '/');

try {
    // Criando a conexão PDO corretamente
    $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

?>
