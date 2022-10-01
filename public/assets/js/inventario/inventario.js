const id_producto = document.querySelector("#id_producto");
const nombre = document.querySelector("#nombre");
const cantidadInput = document.querySelector("#cantidadInput");

function selectProduct(e) {
    console.log();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/store/public/admin/compras/" + e.id,
        type: "GET",
        data: { id: e.id },
        success: function (result) {
            // console.log(result);
            nombre.value = result.nombre;
            codigo.value = result.codigo;
            id_producto.value = result.id;
            cantidadInput.focus();
        },
    });
}
