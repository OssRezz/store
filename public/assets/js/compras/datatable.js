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

// tableDettale = $("#tableDetalle").DataTable({
//     paging: false,
//     lengthChange: false,
//     responsive: true,
//     info: false,
//     dom:
//         "<'row'<'col-sm-12'f>>" +
//         "<'row'<'col-sm-12'tr>>" +
//         "<'row'<'col-sm-5'i><'col-sm-7'p>>",
// });
