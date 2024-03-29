$(document).ready(function () {

    $("#nav-ico-producto").addClass("active");
    

    var listtabla = $('#table-data-producto').DataTable({
        language: {"url": "/js/language_dt_spanish.json"},
        processing: true,
        serverSider: true,
        ajax: '../producto/data',
        columns:[
            {data: 'id'},
            {data: 'nombre'},
            {data: 'descripcion'},
            {data: 'clave_sat'},
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_medida_secundaria !=null){
                        return data.unidad_medida_base + '<br>' + data.unidad_medida_secundaria;
                    }else{
                        return data.unidad_medida_base;
                    }
                }
            },
            {data: 'precio_compra'},
            {data: 'precio_venta'},
            {data: 'precio_minimo'},
            {data: 'btn-history'},
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
            console.log(msg)

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
                'unidad_medida_base': $('#unidad_medida_base_edit').val(),
                'unidad_medida_secundaria': $('#unidad_medida_secundaria_edit').val(),
                'unidad_conversion': $('#unidad_conversion_edit').val(),
                'precio_compra': $('#precio_compra_edit').val(),
                'precio_venta': $('#precio_venta_edit').val(),
                'precio_minimo': $('#precio_minimo_edit').val(),
                'descripcion': $('#descripcion_edit').val(),
                // 'stock_inicial_edit': $('#stock_inicial_edit').val()
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
        $("#precio_venta").val("");
        $("#precio_compra").val("");
        $("#precio_minimo").val("");
        $("#descripcion").val("");
        $("#stock_inicial").val("");
        $("#unidad_medida_base").val("");
        $("#unidad_medida_secundaria").val("");
        $("#unidad_conversion").val("");
        $("#label_um1").empty();
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
        $("#stock_inicial"+identificador).removeClass("is-invalid");
    }  

    $('.numero-entero-positivo').keypress(function (event) {
        // console.log(event.charCode);
        if (
            event.charCode == 43 || //+
            event.charCode == 45 || //-
            event.charCode == 69 || //E
            event.charCode == 101|| //e
            event.charCode == 46    //.
            ){
            return false;
        } 
        return true;
    });

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