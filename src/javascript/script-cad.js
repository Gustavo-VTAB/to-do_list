  
  
  const cadForm = document.getElementById("formCadastro");
  const msgAlerta = document.getElementById("msgAlerta");

    
    cadForm.addEventListener("submit", async(e) => {
        e.preventDefault();

        
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);
        
        const dados = await fetch("./actions-for-account/create.php", {
            method:"POST",
            body: dadosForm,
        });

        const texto = await dados.text(); // pega como texto cru
console.log("Resposta crua:", texto); // imprime pra gente ver

    let resposta;
    try {
        resposta = JSON.parse(texto); // tenta converter pra JSON
    } catch (e) {
        console.error("Erro ao converter JSON:", e);
        return;
    }

    
        //const resposta = await dados.json(); 
        
        console.log(resposta);
    
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            cadForm.reset();

            // Exibir mensagem de sucesso e redirecionar após 2 segundos
            if (resposta['redirect']) {
                setTimeout(() => {
                  window.location.href = resposta['redirect'];
                }, 1500);}
        }
    });
    




