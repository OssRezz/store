const nombre = document.querySelector("#nombre");
const codigo = document.querySelector("#codigo");
const valor_unidad = document.querySelector("#valor_unidad");
const unidades = document.querySelector("#unidades");
const observaciones = document.querySelector("#observaciones");
const usuario = document.querySelector("#usuario");
const factura = document.querySelector("#factura");

let carritoDeCompra = [];
let total;

function selectProduct(e) {
    console.log();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "compras/" + e.id,
        type: "GET",
        data: { id: e.id },
        success: function (result) {
            nombre.value = result.nombre;
            codigo.value = result.codigo;
            valor_unidad.value = result.precio_compra;
            unidades.focus();
        },
    });
}

function agregarProducto() {
    if (
        nombre.value == "" ||
        codigo.value == "" ||
        valor_unidad.value == "" ||
        unidades.value == ""
    ) {
        return alertaToast("Todos los campos son requeridos", "primary");
    }

    carritoDeCompra.length == 0
        ? (carritoDeCompra = [
              {
                  id: Date.now(),
                  nombre: nombre.value,
                  codigo: codigo.value,
                  valor: valor_unidad.value,
                  unidades: unidades.value,
                  observaciones: observaciones.value,
                  total: valor_unidad.value * unidades.value,
              },
          ])
        : (carritoDeCompra = [
              ...carritoDeCompra,
              {
                  id: Date.now(),
                  nombre: nombre.value,
                  codigo: codigo.value,
                  valor: valor_unidad.value,
                  unidades: unidades.value,
                  observaciones: observaciones.value,
                  total: valor_unidad.value * unidades.value,
              },
          ]);

    nombre.value = "";
    codigo.value = "";
    valor_unidad.value = "";
    unidades.value = "";
    cargarCarrito(carritoDeCompra);
    // console.log(carritoDeCompra);
    // return alertaToast("Producto agregado", "success");
}

function cargarCarrito(carrito) {
    clean("#carrito");
    const carritoTabla = document.querySelector("#carrito");
    let html = "";
    carrito.forEach((element) => {
        const { id, nombre, codigo, valor, unidades, observaciones, total } =
            element;
        html += `
            <tr onclick='eliminarProducto(this)' id='${id}' style='cursor: pointer;'>
                <td>${nombre}</td>
                <td class='text-center'>${codigo}</td>
                <td class='text-center'>${unidades}</td>
                <td class='text-center'>${formatter.format(valor)}</td>
                <td class='text-center'>${formatter.format(total)}</td>
            </tr>
        `;
    });

    carritoTabla.innerHTML = html;
    calcularTotal(carrito);
}

function eliminarProducto(e) {
    carritoDeCompra = carritoDeCompra.filter((carrito) => carrito.id != e.id);
    cargarCarrito(carritoDeCompra);
    return alertaToast("Producto eliminado", "danger");
}

function calcularTotal(arr) {
    const sum = arr.reduce((accumulator, object) => {
        return accumulator + object.total;
    }, 0);
    document.querySelector("#total").innerHTML = formatter.format(sum);
    total = sum;
}

const formatter = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
    minimumFractionDigits: 0,
});

function guardarCompra() {
    console.log(carritoDeCompra);
    if (carritoDeCompra.length == 0)
        return alertaToast("No hay compras en el carrito", "primary");
    console.log();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "compras",
        type: "POST",
        data: {
            observaciones: observaciones.value,
            usuario: usuario.value,
            compras: carritoDeCompra,
            total: total,
        },
        success: function (result) {
            clean("#carrito");
            factura.innerHTML = result;
            observaciones.value = "";
            document.querySelector("#total").innerHTML = "";
            return alertaToast("Compra almacenada exitosamente", "success");
        },
    });
}
