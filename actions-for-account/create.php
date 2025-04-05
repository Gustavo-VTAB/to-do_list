
<?php
session_start();
require_once('https://to-dolist-production-0697.up.railway.app/database/conn.php');

// Evita qualquer saída inesperada
header('Content-Type: application/json');

//limpa as variáveis de sessão
//limpa as variáveis de sessão
if (isset($_SESSION['userId'])) {
    unset($_SESSION['userId']);
    unset($_SESSION['userNome']);
}


    $nome = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'password');
    $senhaConfirm = filter_input(INPUT_POST, 'password-confirm');


    if (empty($nome)) {
        echo json_encode(['erro'=> true, 'msg'=> "Preencha o campo Nome"]);
        exit;
    } elseif (empty($email)) {
        echo json_encode(['erro'=> true, 'msg'=> "Preencha o campo Email"]);
        exit;
    } elseif (empty($senha)) {
        echo json_encode(['erro'=> true, 'msg'=> "Preencha o campo Senha"]);
        exit;
    } elseif ($senha !== $senhaConfirm) {
        echo json_encode(['erro'=> true, 'msg'=> "As senhas não conferem"]);
        exit;
    }else {
        $query_users ="INSERT INTO users (user_name, user_email, user_password) VALUES ( :nome, :email, :senha)";
        
        $cadUsers = $pdo->prepare($query_users);
        $cadUsers->bindParam(':nome', $nome);
        $cadUsers->bindParam(':email', $email);
        $cadUsers->bindParam(':senha', $senha);
    
        $cadUsers->execute();
    
        if($cadUsers->rowCount()){

            // Se o usuário foi cadastrado com sucesso, cria a sessão
            $query_users_session = "SELECT user_id, user_name FROM users WHERE user_email = :email AND user_name = :nome AND user_password = :senha";
            $result_session = $pdo->prepare($query_users_session);
            $result_session->bindParam(':email', $email);
            $result_session->bindParam(':nome', $nome);
            $result_session->bindParam(':senha', $senha);
            $result_session->execute();
    
            $session_user = $result_session->fetch(PDO::FETCH_ASSOC);
    
            // Se encontrar o usuário, salva na sessão
            if ($session_user) {
                $_SESSION['userId'] = $session_user['user_id'];
                $_SESSION['userNome'] = $session_user['user_name'];
    
            }

            // Redireciona para a página de tarefas via ajax
            echo json_encode([
                'erro' => false,
                'msg' => "Usuário cadastrado com sucesso",
                'redirect' => 'https://to-dolist-production-0697.up.railway.app/list-tarefas.php'
            ]);

        }else{
            echo json_encode(['erro'=> true, 'msg'=> "Erro: Usuário não cadastrado"]);
            exit;
        }


    }

?>