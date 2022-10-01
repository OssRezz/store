function cerrarToast() {
    const contenedorToats = document.querySelector(".toast");
    contenedorToats.classList.remove("show");
    contenedorToats.classList.add("animate__fadeOut");
    clean("#toats");
}

function alertaToast(mensaje, color) {
    clean("#toats");
    const contenedorToats = document.querySelector("#toats");
    const firstDiv = document.createElement("div");
    firstDiv.style.position = "fixed";
    firstDiv.style.bottom = "90%";
    firstDiv.style.right = "1%";
    firstDiv.style.zIndex = "9999";
    firstDiv.style.float = "right";
    firstDiv.setAttribute("aria-live", "polite");
    firstDiv.setAttribute("aria-atomic", true);

    const seconDiv = document.createElement("div");
    seconDiv.style.position = "absolute";
    seconDiv.style.top = "0%";
    seconDiv.style.right = "0";

    const toast = document.createElement("div");
    toast.setAttribute("role", "alert");
    toast.setAttribute("aria-live", "assertive");
    toast.setAttribute("aria-atomic", true);
    toast.classList.add(
        "toast",
        "show",
        "bg-" + color,
        "border-0",
        "text-white",
        "animate__animated",
        "animate__fadeIn",
        "animate__faster"
    );

    const toastHeader = document.createElement("div");
    toastHeader.classList.add(
        "toast-header",
        "bg-" + color,
        "text-white",
        "d-flex",
        "justify-content-between"
    );

    const headerCol = document.createElement("div");
    headerCol.classList.add("col");

    const icon = document.createElement("icon");
    icon.classList.add("fas", "fa-exclamation-triangle", "text-light", "mx-1");

    const contentCol = document.createElement("strong");
    contentCol.textContent = "Alerta";

    const divButton = document.createElement("div");
    const button = document.createElement("button");
    button.classList.add("btn-close", "btn-close-white");
    button.id = "close-toast";
    button.addEventListener("click", cerrarToast);
    // button.setAttribute("aria-hidden", "true");

    const toastBody = document.createElement("div");
    toastBody.classList.add("toast-body");
    toastBody.textContent = mensaje;

    divButton.appendChild(button);
    headerCol.appendChild(icon);
    headerCol.appendChild(contentCol);
    toastHeader.appendChild(headerCol);
    toastHeader.appendChild(divButton);
    toast.appendChild(toastHeader);
    toast.appendChild(toastBody);

    seconDiv.appendChild(toast);
    firstDiv.appendChild(seconDiv);

    contenedorToats.appendChild(firstDiv);

    setTimeout(() => {
        toast.classList.remove("animate__fadeIn");
        toast.classList.remove("show");
        toast.classList.add("animate__fadeOut");
        // toast.hidden = true;
        clean("#toats");
    }, 5000);
}

//Function recibe el tipo de datao a limpiar
//#id, .clase
function clean(cleanHtml) {
    const aux = document.querySelector(cleanHtml);

    while (aux.firstChild) {
        aux.removeChild(aux.firstChild);
    }
}
