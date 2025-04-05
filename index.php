<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="src/styles/style-login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div id="rain"></div>

    <div class=" login">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 16px;">
            <h3 class="text-center mb-4">Login</h3>
            <form class="form-login" id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="email" placeholder="Digite seu e-mail">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" autocomplete="current-password" placeholder="Digite sua senha">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
                <div id="resposta" class="mt-3"></div>
                <div class="text-center">
                    <a  href="./criar-conta.php">Não tem conta? Crie uma!</a>
                </div>
            </form>

        </div>
        <div id="container">
            <form id="search">
                <i class="fa-solid fa-location-dot"></i>
                <input type="search" name="city_name" id="city_name" placeholder="Buscar cidade">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <div id="weather">

                <div id="infos">
                    <div id="temp">
                        <img id="temp_img" src="https://openweathermap.org/img/wn/04d@2x.png" alt="">

                        <div>
                            <p id="temp_value">
                                32
                            </p>
                            <p id="temp_description">
                                Ensolarado
                            </p>
                            <h1 id="title">Rolante, BR</h1>
                        </div>
                    </div>

                    <div id="other_infos">
                        <div class="info">
                            <i id="temp_max_icon" class="fa-solid fa-temperature-high"></i>

                            <div>
                                <h2>Temp. max</h2>

                                <p id="temp_max">
                                    32 <sup>C°</sup>
                                </p>
                            </div>
                        </div>

                        <div class="info">
                            <i id="temp_min_icon" class="fa-solid fa-temperature-low"></i>

                            <div>
                                <h2>Temp. min</h2>

                                <p id="temp_min">
                                    12 <sup>C°</sup>
                                </p>
                            </div>
                        </div>

                        <div class="info">
                            <i id="humidity_icon" class="fa-solid fa-droplet"></i>

                            <div>
                                <h2>Humidade</h2>
                                <p id="humidity">50%</p> <!-- Altere esse valor para testar -->

                            </div>
                        </div>

                        <div class="info">
                            <i id="wind_icon" class="fa-solid fa-wind"></i>

                            <div>
                                <h2>Vento</h2>

                                <p id="wind">
                                    50 km/h
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="alert"></div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://to-dolist-production-0697.up.railway.app/src/javascript/script-login.js"></script>
</body>

</html>