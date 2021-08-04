$(document).ready(function () {

    $("#nav-ico-producto").addClass("active");
    

    var listtabla = $('#table-data-producto').DataTable({
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
        ajax: '/producto/data',
        columns:[
            {data: 'nombre'},
            {data: 'descripcion'},
            {data: 'clave_sat'},
            {data: 'unidad_medida'}, //aqui va estatus
            {data: 'precio_unitario'},
            // {data: 'btn-show'},
            {data: 'btn-edit'},
            {data: 'btn-delete'},
        ]
    });

    $(document).on("click","#btn-insertar", insertar_fila);
    $(document).on("click",".btn-class-edit", llenar_campos_edit);
    $(document).on("click","#btn-update", update_fila);
    $(document).on("click",".btn-class-delete", destroy_fila);
    // $(document).on("click","#btneliminar",metodo_eliminar);



    function insertar_fila() {

        remove_class_invalid("");

        $.ajax({
            method: "POST",
            url: "/producto/create",
            data: $("#form-create").serialize(),
        })
            .done(function (msg) {
                mensaje_succes('#modal-insertar');
                limpiar_campos();
                listtabla.ajax.reload(null,false);
            }).fail(function (jqXHR) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Verifica tus datos!',
                    width: '20rem',
                })

                var status = jqXHR.status;
                if (status === 422) {
                    $.each(jqXHR.responseJSON.errors, function (key, value) {
                        var idError = "#" + key ;
                        //$(idError).removeClass("d-none");
                        $(idError).addClass('is-invalid');
                    });
                }
            });
        return false;
    }

    function llenar_campos_edit() {
        remove_class_invalid("_edit");
        $.get('/producto/show/' + $(this).data('id') , function(msg) {
            $.each(msg.data, function (key, value) {
                var variable = "#" + key + "_edit";
                $(variable).val(value);
            });
        })
        $("#modal-edit").modal("show");
    }

    function update_fila(){
        remove_class_invalid("_edit");
        $.ajax({
            method: "POST",
            url: "update/"+$('#id_edit').val()+'',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#id_edit').val(),
                'nombre': $('#nombre_edit').val(),
                'clave_sat': $('#clave_sat_edit').val(),
                'unidad_medida': $('#unidad_medida_edit').val(),
                'precio_unitario': $('#precio_unitario_edit').val(),
                'descripcion': $('#descripcion_edit').val()
                },
        })
            .done(function (msg) {
                mensaje_succes('#modal-edit');
                limpiar_campos();
                listtabla.ajax.reload(null,false);     

            }).fail(function (jqXHR) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Verifica tus datos!',
                    width: '20rem',
                })

                var status = jqXHR.status;
                if (status === 422) {
                    $.each(jqXHR.responseJSON.errors, function (key, value) {
                        var idError = "#" + key ;
                        $(idError).addClass('is-invalid');
                    });
                }
            });
        return false;
    }

    function mensaje_succes(modal) {
        $(modal).modal("hide");
        Swal.fire({
            icon: 'success',
            title: 'Guardado Correctamente',
            showConfirmButton: false,
            timer: 1500
        })

    }

    function limpiar_campos() {
        $("#nombre").val("");
        $("#clave_sat").val("");
        $("#unidad_medida").val("");
        $("#precio_unitario").val("");
        $("#descripcion").val("");
    }   

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
                console.log();

                $.ajax({
                    method: "get",
                    url: "destroy/"+$(this).data('id'),
                }).done(function () {
                    listtabla.ajax.reload(null,false); 
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu producto ha sido eliminado',
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

    function remove_class_invalid(identificador) {
        $("#nombre"+identificador).removeClass("is-invalid");
        $("#clave_sat"+identificador).removeClass("is-invalid");
        $("#unidad_medida"+identificador).removeClass("is-invalid");
        $("#precio_unitario"+identificador).removeClass("is-invalid");
        $("#descripcion"+identificador).removeClass("is-invalid");
    }  








    $('.numero-decimal-positivo').keypress(function (event) {
        // console.log(event.charCode);
        if (
            event.charCode == 43 || //+
            event.charCode == 45 || //-
            event.charCode == 69 || //E
            event.charCode == 101 //e
            ){
            return false;
        } 
        return true;
    });

});