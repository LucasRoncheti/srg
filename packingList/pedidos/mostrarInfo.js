

//essa função mostra as informações abaixo do produto  como valor unit e nome do produto 

let trocarDisplay = (id, img) => {
    let div = document.getElementById(id)
    let imgem = document.getElementById(img)

    var eyeSlashsrc = "../../assets/eyeSlash.svg"
    var eyesrc = "../../assets/eye.svg"

    if (div.style.display == "none") {
        div.style.display = "flex"
        imgem.src = eyeSlashsrc
    } else {
        div.style.display = "none"
        imgem.src = eyesrc
    }
}