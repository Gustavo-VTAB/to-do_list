$(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        let email = $('input[name="email"]').val().trim();
        let senha = $('input[name="senha"]').val().trim();

        if (email === '' || senha === '') {
            $('#resposta').html('<div class="alert alert-danger">Preencha todos os campos.</div>');
            return;
        }

        $.ajax({
            url: './actions-for-account/login.php',
            type: 'POST',
            data: { email: email, senha: senha },
            dataType: 'json',
            success: function (resposta) {
                console.log("Resposta do login:", resposta);
                if (resposta.status === "success") {
                    window.location.href = "https://to-dolist-production-0697.up.railway.app/list-tarefas.php";
                } else {
                    $('#resposta').html('<div class="alert alert-danger">' + resposta.message + '</div>');
                }
            },
            error: function (xhr, status, error) {
                $('#resposta').html('<div class="alert alert-danger">Erro ao processar o login.</div>');
                console.log(xhr.responseText); // aqui mostra a resposta real do servidor
            }
        });
    });
});


//api openweathermap
document.querySelector('#search').addEventListener('submit', async (event) => {
    event.preventDefault();

    const cityName = document.querySelector('#city_name').value;

    if (!cityName) {
        document.querySelector("#weather").classList.remove('show');
        showAlert('Você precisa digitar uma cidade...');
        return;
    }

    const apiKey = '8a60b2de14f7a17c7a11706b2cfcd87c';
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURI(cityName)}&appid=${apiKey}&units=metric&lang=pt_br`

    const results = await fetch(apiUrl);
    const json = await results.json();

    if (json.cod === 200) {
        showInfo({
            city: json.name,
            country: json.sys.country,
            temp: json.main.temp,
            tempMax: json.main.temp_max,
            tempMin: json.main.temp_min,
            description: json.weather[0].description,
            tempIcon: json.weather[0].icon,
            windSpeed: json.wind.speed,
            humidity: json.main.humidity,
        });
    } else {
        document.querySelector("#weather").classList.remove('show');
        showAlert(`
            Não foi possível localizar...

            <img src="src/images/404.svg"/>
        `)
    }
});

// Função para mostrar as informações do clima
function showInfo(json){
    showAlert('');

    document.querySelector("#weather").classList.add('show');

    document.querySelector('#title').innerHTML = `${json.city}, ${json.country}`;

    // Atualiza a temperatura para o formato correto com vírgula e adiciona o símbolo de grau Celsius
    document.querySelector('#temp_value').innerHTML = `${json.temp.toFixed(1).toString().replace('.', ',')} <sup>C°</sup>`;
    document.querySelector('#temp_description').innerHTML = `${json.description}`;
    document.querySelector('#temp_img').setAttribute('src', `https://openweathermap.org/img/wn/${json.tempIcon}@2x.png`)

    // Atualiza os valores de temperatura máxima e mínima para o formato correto com vírgula
    document.querySelector('#temp_max').innerHTML = `${json.tempMax.toFixed(1).toString().replace('.', ',')} <sup>C°</sup>`;
    document.querySelector('#temp_min').innerHTML = `${json.tempMin.toFixed(1).toString().replace('.', ',')} <sup>C°</sup>`;
    document.querySelector('#humidity').innerHTML = `${json.humidity}%`;
    document.querySelector('#wind').innerHTML = `${json.windSpeed.toFixed(1)}km/h`;

    // Verifica se a umidade está acima de 80% para iniciar a animação de chuva
    if (json.humidity > 80) {
        startRainAnimation();
    } else {
        stopRainAnimation();
    }
}

function showAlert(msg) {
    document.querySelector('#alert').innerHTML = msg;
}

// Animação de chuva
let rainInterval;
// Cria um elemento de gota de chuva e o adiciona ao DOM
function createRainrop() {
    const drop = document.createElement('div');
    drop.className = 'drop';
    drop.style.left = `${Math.random() * window.innerWidth}px`;
    drop.style.animationDuration = `${0.5 + Math.random()}s`;
    document.getElementById('rain').appendChild(drop);

    // Remove a gota de chuva após 2 segundos
    setTimeout(() => {
        drop.remove();
    }, 2000);
}
// Inicia a animação de chuva
function startRainAnimation() {
    clearInterval(rainInterval); // evita múltiplos intervalos
    document.getElementById('rain').style.display = 'block';
    rainInterval = setInterval(createRainrop, 100);
}
// Para parar a animação de chuva
function stopRainAnimation() {
    clearInterval(rainInterval);
    document.getElementById('rain').innerHTML = '';
    document.getElementById('rain').style.display = 'none';
}

  

