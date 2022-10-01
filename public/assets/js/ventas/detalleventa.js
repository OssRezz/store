const nombre = document.querySelector("#nombre");
const codigo = document.querySelector("#codigo");
const valor_unidad = document.querySelector("#valor_unidad");
const unidades = document.querySelector("#unidades");
const observaciones = document.querySelector("#observaciones");
const usuario = document.querySelector("#usuario");
const selectTipoVenta = document.querySelector("#selectTipoVenta");
const colDescuento = document.querySelector("#colDescuento");
const descuento = document.querySelector("#descuento");
const existencias = document.querySelector("#existencias");
const segundaOpcion = document.querySelector("#segundaOpcion");
const forma_pago = document.querySelector("#forma_pago");
const segunda_forma_pago = document.querySelector("#segunda_forma_pago");
const colSegundaForma = document.querySelector("#colSegundaForma");
const colValorSegunda = document.querySelector("#colValorSegunda");
const valor_pago_dos = document.querySelector("#valor_pago_dos");
const factura = document.querySelector("#factura");
const contenidoVenta = document.querySelector("#contenidoVenta");
console.log(JSON.parse(contenidoVenta.value));
const formatter = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
    minimumFractionDigits: 0,
});

let carritoDeVenta = [];
let total;

cargarVentas();
function cargarVentas() {
    const ventas = JSON.parse(contenidoVenta.value);

    ventas.forEach((element) => {
        const {} = element;
        carritoDeVenta.length == 0
            ? (carritoDeVenta = [
                  {
                      id: element.id,
                      nombre: element.producto_fk.nombre,
                      codigo: element.producto_fk.codigo,
                      valor: element.producto_fk.precio_venta,
                      unidades: element.cantidad,
                      descuento: element.descuento,
                      total: element.valor,
                      tipo_venta: element.tipo_venta,
                  },
              ])
            : (carritoDeVenta = [
                  ...carritoDeVenta,
                  {
                      id: element.id,
                      nombre: element.producto_fk.nombre,
                      codigo: element.producto_fk.codigo,
                      valor: element.producto_fk.precio_venta,
                      unidades: element.cantidad,
                      descuento: element.descuento,
                      total: element.valor,
                      tipo_venta: element.tipo_venta,
                  },
              ]);
    });

    cargarCarrito(carritoDeVenta);
}

function selectProduct(e) {
    console.log();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/store/public/admin/ventas/" + e.id,
        type: "GET",
        data: { id: e.id },
        success: function (result) {
            console.log(result);
            nombre.value = result.nombre;
            codigo.value = result.codigo;
            valor_unidad.value = result.precio_venta;
            existencias.value = result.cantidad;
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
    const dcto = descuento.value == null ? 0 : descuento.value;

    carritoDeVenta.length == 0
        ? (carritoDeVenta = [
              {
                  id: Date.now(),
                  nombre: nombre.value,
                  codigo: codigo.value,
                  valor: valor_unidad.value,
                  unidades: unidades.value,
                  descuento: dcto,
                  total: valor_unidad.value * unidades.value - dcto,
                  tipo_venta: selectTipoVenta.value,
              },
          ])
        : (carritoDeVenta = [
              ...carritoDeVenta,
              {
                  id: Date.now(),
                  nombre: nombre.value,
                  codigo: codigo.value,
                  valor: valor_unidad.value,
                  unidades: unidades.value,
                  descuento: dcto,
                  total: valor_unidad.value * unidades.value - dcto,
                  tipo_venta: selectTipoVenta.value,
              },
          ]);

    nombre.value = "";
    codigo.value = "";
    valor_unidad.value = "";
    unidades.value = "";
    cargarCarrito(carritoDeVenta);
    console.log(carritoDeVenta);
    // return alertaToast("Producto agregado", "success");
}

function cargarCarrito(carrito) {
    clean("#carrito");
    const carritoTabla = document.querySelector("#carrito");
    let html = "";
    carrito.forEach((element) => {
        const { id, nombre, codigo, valor, unidades, total, descuento } =
            element;
        html += `
            <tr onclick='eliminarProducto(this)' id='${id}' style='cursor: pointer;'>
                <td>${nombre}</td>
                <td class='text-end'>${codigo}</td>
                <td class='text-end'>${unidades}</td>
                <td class='text-end'>${formatter.format(valor)}</td>
                <td class='text-end'>${formatter.format(descuento)}</td>
                <td class='text-end'>${formatter.format(total)}</td>
            </tr>
        `;
    });

    carritoTabla.innerHTML = html;
    calcularTotal(carrito);
}

function eliminarProducto(e) {
    carritoDeVenta = carritoDeVenta.filter((carrito) => carrito.id != e.id);
    cargarCarrito(carritoDeVenta);
    return alertaToast("Producto eliminado", "danger");
}

function calcularTotal(arr) {
    const sum = arr.reduce((accumulator, object) => {
        return accumulator + object.total;
    }, 0);
    document.querySelector("#total").innerHTML = formatter.format(sum);
    total = sum;
}

selectTipoVenta.addEventListener("change", () => {
    if (selectTipoVenta.value == "Por mayor") {
        descuento.value = 0;
        colDescuento.removeAttribute("hidden");
    } else {
        descuento.value = 0;
        colDescuento.setAttribute("hidden", true);
    }
});

segundaOpcion.addEventListener("click", () => {
    if (colSegundaForma.hidden == true) {
        colSegundaForma.removeAttribute("hidden");
        colValorSegunda.removeAttribute("hidden");
    } else {
        colSegundaForma.setAttribute("hidden", true);
        colValorSegunda.setAttribute("hidden", true);
    }
});

forma_pago.addEventListener("change", () => {
    clean("#segunda_forma_pago");
    let formaDePago = ["Efectivo", "Transacción", "Credito"];
    formaDePago = formaDePago.filter((forma) => forma != forma_pago.value);
    formaDePago.forEach((element) => {
        let option = document.createElement("option");
        option.value = element;
        option.innerHTML = element;
        segunda_forma_pago.append(option);
    });
});

function actualizarCompra() {
    // console.log(carritoDeVenta);
    if (carritoDeVenta.length == 0)
        return alertaToast("No hay ventas en el carrito", "primary");
    if (forma_pago.value == "")
        return alertaToast("La forma de pago es requerida", "primary");

    if (colSegundaForma.hidden == false && valor_pago_dos.value == "")
        return alertaToast(
            "El valor de la segunda forma de pago es requerido",
            "primary"
        );

    if (total < valor_pago_dos.value)
        return alertaToast(
            "El valor de la segunda forma de pago, no puede ser mayor al valor total",
            "primary"
        );

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/store/public/admin/detalleventa",
        type: "POST",
        data: {
            factura: factura.classList.value,
            observaciones: observaciones.value,
            ventas: carritoDeVenta,
            total: total,
            forma_pago: forma_pago.value,
            forma_pago_dos:
                colSegundaForma.hidden == true
                    ? null
                    : segunda_forma_pago.value,
            valor_pago_dos:
                colSegundaForma.hidden == true ? null : valor_pago_dos.value,
        },
        success: function (result) {
            console.log(result);
            cargarIventario(result);
            alertaToast("Venta actualizada exitosamente", "success");
        },
    });
}

function cargarIventario(iventario) {
    table.clear();
    table.destroy();
    const tablaInventario = document.querySelector("#tablaInventario");
    let html = "";
    iventario.forEach((element) => {
        const { id, nombre, codigo, cantidad, precio_venta } = element;
        html += `
            <tr onclick='selectProduct(this)' id='${id}' style='cursor: pointer;'>
                <td>${nombre}</td>
                <td class='text-end'>${codigo}</td>
                <td class='text-end'>${cantidad}</td>
                <td class='text-end'>${formatter.format(precio_venta)}</td>
            </tr>
        `;
    });
    tablaInventario.innerHTML = html;
    table = $("#tableclient").DataTable({
        paging: true,
        lengthChange: false,
        responsive: true,
        pagingType: "simple",
        info: false,
        dom:
            "<'row'<'col-sm-12'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });
}
