//função para abrir a imgagem em melhor definição

let abrirImgHD =(id)=>{
    div = document.getElementById(id)

    if(div.style.display === "none"){
        div.style.display = 'flex'
    }else{
        div.style.display = 'none'
    }
    
}

// onclick="abrirImgHD(\''.$pathHD.'\')"
// <div style="display:none;"  id="'. $pathHD.'" class="imagemHD">
// <div  onclick="abrirImgHD(\''.$pathHD.'\')" class="closeButton">X</div>
// <img src="'. $pathHD.'">
// </div>