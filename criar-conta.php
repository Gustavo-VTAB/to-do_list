<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/styles/style.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div  class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow p-4"  style="width: 100%; max-width: 400px; border-radius: 16px;">

          <h3 class="text-center mb-4">Criar conta</h3>
          
          <span id="msgAlerta"></span>

          <form method="POST" id="formCadastro" class="form-cad">
            <div class="mb-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" required>
            </div>
          
            <div class="mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            
            <div class="mb-3">
              <label for="senha" class="form-label">Senha</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
          
            <div class="mb-3">
              <label for="senha-confirmar" class="form-label">Confirmar Senha</label>
              <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Confirme sua Senha">
            </div>
          
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Criar</button>
            </div>

            <p class="text-center mt-3 mb-0">
              <a href="./index.php">Já tem conta? Login</a>
            </p>
          </form>
        </div>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./src/javascript/script-cad.js"></script>
</body>
</html>