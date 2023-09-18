    document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("cadastroForm");
   
    
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        
        const usuario = document.getElementById("nome").value;
        const senha = document.getElementById("senha").value;
        const senha1 = document.getElementById("senha1").value;

        if(senha === senha1){

      
     
        
            
            fetch("cadastro.php", {
                method: "POST",
                body: new URLSearchParams({ usuario, senha })
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                form.reset();
                listar(1,10)
            
                
            });
        }else{
            alert('A senha não corresponde! Favor conferir novamente.')
        }
        
    });

   
  
});
