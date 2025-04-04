  
  
  const cadForm = document.getElementById("formCadastro");
  const msgAlerta = document.getElementById("msgAlerta");

    
    cadForm.addEventListener("submit", async(e) => {
        e.preventDefault();

        
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);
        
        const dados = await fetch("https://to-dolist-production-0697.up.railway.app//actions-for-account/create.php", {
            method:"POST",
            body: dadosForm,
        });

    

    
        const resposta = await dados.json(); 
        
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
    




