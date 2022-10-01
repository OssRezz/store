const donaProductos = document.getElementById("chartDonaProductos");
let nombreProducto = [];
let totalProducto = [];

loadChartDonaProductos();

const dataDonaProductos = {
    labels: nombreProducto,
    datasets: [
        {
            label: "# Productos mas vendidos",
            data: totalProducto,
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
            ],
            borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
            ],
            borderWidth: 1,
            borderRadius: 10,
            offset: 10,
            hoverOffset: 30,
        },
    ],
};

const configDona = {
    type: "doughnut",
    data: dataDonaProductos,
    options: {
        responsive: true,
        cutout: "70%",
        layout: {
            padding: 25,
        },
    },
};

function loadChartDonaProductos() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportes/chartDonaProductos",
        type: "GET",
        success: function (result) {
            console.log(result);
            result.forEach((element) => {
                const { nombre, cantidad_producto } = element;
                nombreProducto.push(nombre);
                totalProducto.push(cantidad_producto);
            });
            const chartDonaProductos = new Chart(donaProductos, configDona);
        },
    });
}
