<?php
session_start();
header('Content-Type: application/json');

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../database/conn.php'); // Caminho local para o seu banco
 // Conexão com o banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');

    if (!$email || empty($senha)) {
        echo json_encode(["status" => "error", "message" => "Preencha todos os campos corretamente!"]);
        exit;
    }

    // Busca usuário no banco
    $sql = $pdo->prepare("SELECT * FROM users WHERE user_email = :email AND user_password = :senha");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user && $sql->rowCount() > 0) {
        // Se o usuário existe, cria a sessão
        $_SESSION['user'] = [
           'id' => $user['user_id'],
           'name' => $user['user_name']
        ];
        
        echo json_encode(["status" => "success", "message" => "Login realizado com sucesso!" ]);
    } else {
        echo json_encode(["status" => "error", "message" => "E-mail ou senha incorretos."]);
    }
}
?>
