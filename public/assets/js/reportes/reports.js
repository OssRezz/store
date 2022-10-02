const getReport = () => {
    const fecha_inicio = document.querySelector("#fecha_inicio").value;
    const fecha_fin = document.querySelector("#fecha_fin").value;
    const reporte = document.querySelector("#reporte").value;

    if (reporte == "Ventas") {
        Ventas(fecha_inicio, fecha_fin);
    } else if (reporte == "Compras") {
        Compras(fecha_inicio, fecha_fin);
    } else {
        TotalPorPago(fecha_inicio, fecha_fin);
    }
};

const Ventas = (fecha_inicio, fecha_fin) => {
    $.ajax({
        xhrFields: {
            responseType: "blob",
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "ventas/export",
        type: "POST",
        data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
        success: function (result, status, xhr) {
            exportExcel(result, status, xhr, "Ventas", fecha_inicio, fecha_fin);
            return alertaToast("Reporte generado", "success");
        },
        error: function (error) {
            alertaToast("La fecha de inicio y final son requeridas", "warning");
        },
    });
};

const Compras = (fecha_inicio, fecha_fin) => {
    $.ajax({
        xhrFields: {
            responseType: "blob",
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "compras/export",
        type: "POST",
        data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
        success: function (result, status, xhr) {
            exportExcel(
                result,
                status,
                xhr,
                "Compras",
                fecha_inicio,
                fecha_fin
            );
            return alertaToast("Reporte generado", "success");
        },
        error: function (error) {
            alertaToast("La fecha de inicio y final son requeridas", "warning");
        },
    });
};

const TotalPorPago = (fecha_inicio, fecha_fin) => {
    $.ajax({
        xhrFields: {
            responseType: "blob",
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "ventas_pago/export",
        type: "POST",
        data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin },
        success: function (result, status, xhr) {
            exportExcel(
                result,
                status,
                xhr,
                "Ventas por tipo de pago",
                fecha_inicio,
                fecha_fin
            );
            return alertaToast("Reporte generado", "success");
        },
        error: function (error) {
            alertaToast("La fecha de inicio y final son requeridas", "warning");
        },
    });
};

const exportExcel = (result, status, xhr, name, fecha_inicio, fecha_fin) => {
    const tiempoTranscurrido = Date.now();
    const hoy = new Date(tiempoTranscurrido);
    var disposition = xhr.getResponseHeader("content-disposition");
    var matches = /"([^"]*)"/.exec(disposition);
    var filename =
        matches != null && matches[1]
            ? matches[1]
            : `${name} desde ${fecha_inicio}, hasta ${fecha_fin}.xlsx`;

    // The actual download
    var blob = new Blob([result], {
        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    });
    var link = document.createElement("a");
    link.href = window.URL.createObjectURL(blob);
    link.download = filename;

    document.body.appendChild(link);

    link.click();
    document.body.removeChild(link);
};
