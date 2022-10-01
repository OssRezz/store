const chartLine = document.getElementById("myChart2");
let fechas = [];
let totales = [];

loadChartLine();

const dataLinea = {
    labels: fechas,
    datasets: [
        {
            label: "Ventas",
            data: totales,
            borderColor: "rgba(75, 192, 192, 0.2)",
            backgroundColor: "rgba(75, 192, 192, 1)",
            borderWidth: 7,
            pointRadius: 10,
            pointHoverRadius: 16,
        },
    ],
};

const configLinea = {
    type: "line",
    data: dataLinea,
    options: {
        tension: 0.45,
        responsive: true,
    },
};

function loadChartLine() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "reportes/chartLine",
        type: "GET",
        success: function (result) {
            // console.log(result);
            result.forEach((element) => {
                const { fecha, total } = element;
                fechas.push(fecha);
                totales.push(total);
                // fechas = [...fechas, fecha];
                // totales = [...totales, total];
            });
            console.log(fechas);
            const stackedLine = new Chart(chartLine, configLinea);
        },
    });
}
