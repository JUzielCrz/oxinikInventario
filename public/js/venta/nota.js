$("#nav-ico-almacen").addClass("active");
    
$(document).ready(function () {

    var listtabla = $('#table-notas').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        processing: true,
        serverSider: true,
        ajax: '/venta/nota/data',
        columns:[
            {data: 'idVenta'},
            {data: 'cliente'},
            {data: 'tipo_folio'},
            {data: 'folio'},
            {data: 'fecha'},
            {data: 'total_general'},
            {data: 'btnShow'},
        ]
    });

});