$("#nav-ico-almacen").addClass("active");
    
$(document).ready(function () {

    var listtabla = $('#table-notas').DataTable({
        language: {"url": "/js/language_dt_spanish.json"},
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
            {data: 'buttons'},
        ]
    });

    $(document).on("click",".btn-destroy", destroy_fila);

    function destroy_fila(){
        Swal.fire({
            title: '¿Estas segur@?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, bórralo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    method: "delete",
                    url: "/venta/nota/destroy/"+$(this).data('id'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done(function () {
                    listtabla.ajax.reload(null,false); 
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminado Correctamente',
                        'success'
                    )
                }).fail(function (){
                    Swal.fire(
                        'Error!',
                        'El producto no se puede eliminar',
                        'error'
                    )
                });
            }
        })
    }
});