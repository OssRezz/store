const hamburguer = document.querySelector(".hb");
const sidebar = document.querySelector("#sidebar");
const sidebarCollapse = document.querySelector("#sidebarCollapse");
const iconHb = document.querySelector("#iconHb");

hamburguer.addEventListener("click", ocultarLateral);

/*
Cuando el boton hamburguer sea precionado, El sistema analiza si tiene la clase
active, en caso de tenerla la remueve y en caso de no tenerla la agrega.
 */
function ocultarLateral() {
    if (sidebar.classList.contains("active")) {
        hamburguer.classList.remove("red-bg");
        hamburguer.classList.remove("border", "border-black");
        iconHb.classList.remove("text-white");
        sidebar.classList.remove("active");

        sessionStorage.setItem("menuHb", "open");
    } else {
        hamburguer.classList.add("red-bg");
        hamburguer.classList.add("border", "border-black");
        iconHb.classList.add("text-white");
        sidebar.classList.add("active");

        sessionStorage.setItem("menuHb", "close");
    }
}

//Si la pantalla es mayor a 750 de ancho, Va a recorrer el if
window.onload = () => {
    if (screen.width > 750) {
        if (sessionStorage.getItem("menuHb") !== "open") {
            if (sessionStorage.getItem("menuHb") == "close") {
                ocultarLateral();
            }
        }
    }
};