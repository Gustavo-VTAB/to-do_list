<?php
// logout.php
session_start();
session_destroy(); // Remove todos os dados da sessão
header("Location: https://to-dolist-production-0697.up.railway.app/index.php"); // Redireciona para o login
exit;


?>