<?php
$database_url = "mysql://root:xIXsTWegyDeJQCTvBHQPJMFBWRVZLrjC@interchange.proxy.rlwy.net:59171/railway";
$parsed_url = parse_url($database_url);

$hostname = $parsed_url["host"];
$port     = $parsed_url["port"];
$username = $parsed_url["user"];
$password = $parsed_url["pass"];
$database = ltrim($parsed_url["path"], '/');

try {
    $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['erro' => true, 'msg' => "Erro na conexão: " . $e->getMessage()]);
    exit;
}
?>
