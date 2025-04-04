<?php
require_once('../database/conn.php');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$completed = filter_input(INPUT_POST, 'completed', FILTER_VALIDATE_INT);

if ($completed === 1) {
    $status = 2; // Concluída
} elseif ($completed === 0) {
    $status = 1; // Em andamento
} else {
    $status = 0; // Pendente
}

if ($id !== false && $completed !== false) {
    $sql = $pdo->prepare("UPDATE task SET completed = :completed, status = :status WHERE id = :id");
    $sql->bindValue(':completed', $completed, PDO::PARAM_INT); 
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    $sql->bindValue(':status', $status, PDO::PARAM_INT); 
    $sql->execute();

    echo json_encode(['success' => true]);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

?>
