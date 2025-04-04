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
            url: '../../actions-for-account/login.php',
            type: 'POST',
            data: { email: email, senha: senha },
            dataType: 'json',
            success: function (resposta) {
                if (resposta.status === "success") {
                    window.location.href = "../../list-tarefas.php"; // Página pós-login
                } else {
                    $('#resposta').html('<div class="alert alert-danger">' + resposta.message + '</div>');
                }
            },
            error: function () {
                $('#resposta').html('<div class="alert alert-danger">Erro ao processar o login.</div>');
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

    document.querySelector('#temp_value').innerHTML = `${json.temp.toFixed(1).toString().replace('.', ',')} <sup>C°</sup>`;
    document.querySelector('#temp_description').innerHTML = `${json.description}`;
    document.querySelector('#temp_img').setAttribute('src', `https://openweathermap.org/img/wn/${json.tempIcon}@2x.png`)

    document.querySelector('#temp_max').innerHTML = `${json.tempMax.toFixed(1).toString().replace('.', ',')} <sup>C°</sup>`;
    document.querySelector('#temp_min').innerHTML = `${json.tempMin.toFixed(1).toString().replace('.', ',')} <sup>C°</sup>`;
    document.querySelector('#humidity').innerHTML = `${json.humidity}%`;
    document.querySelector('#wind').innerHTML = `${json.windSpeed.toFixed(1)}km/h`;
}

function showAlert(msg) {
    document.querySelector('#alert').innerHTML = msg;
}

// Animação de chuva
function createRainrop() {
    const drop = document.createElement('div');
    drop.className = 'drop';
  
    // Posição horizontal aleatória
    drop.style.left = Math.random() * window.innerWidth + 'px';
  
    // Tamanho e opacidade aleatória
    const size = Math.random() * 2 + 1; // entre 1px e 3px
    drop.style.width = `${size}px`;
    drop.style.height = `${size * 10}px`; // mais alongada
    drop.style.opacity = Math.random() * 0.5 + 0.3;
  
    // Duração e atraso aleatório da animação
    const duration = Math.random() * 0.7 + 0.3; // entre 0.3s e 1.0s
    const delay = Math.random() * 2;
  
    drop.style.animationDuration = `${duration}s`;
    drop.style.animationDelay = `${delay}s`;
  
    document.getElementById('rain').appendChild(drop);
  
    setTimeout(() => drop.remove(), duration * 1000 + delay * 1000 + 200);
  }
  

