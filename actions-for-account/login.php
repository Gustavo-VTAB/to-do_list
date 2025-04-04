<?php
require_once('../database/conn.php'); // Conexão com o banco
session_start();

//limpa as variáveis de sessão
if (isset($_SESSION['userId'])) {
    unset($_SESSION['userId']);
    unset($_SESSION['userNome']);
    session_destroy();  // Destroi a sessão
    session_start(); // Reinicia a sessão  
}

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
        $_SESSION['user'] = $user['user_name'];
        echo json_encode(["status" => "success", "message" => "Login realizado com sucesso!" ]);
    } else {
        echo json_encode(["status" => "error", "message" => "E-mail ou senha incorretos."]);
    }
}
?>
