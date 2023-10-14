$(document).ready(function () {

    $("#nav-ico-almacen").addClass("active");
    

    var listtabla = $('#table-data-almacen').DataTable({
        language: {"url": "/js/language_dt_spanish.json"},
        processing: true,
        serverSider: true,
        ajax: '/almacen/fiscal/data',
        columns:[
            {data: 'nombre'},
            {data: 'clave_sat'},
            //entradas
            {
                data: null,
                render: function (data, type, row) {
                    return data.entradas + ' ' + data.unidad_medida_base;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_conversion != null && data.unidad_medida_secundaria != null){
                        const um2 = data.entradas / data.unidad_conversion
                        return  um2  + ' ' + data.unidad_medida_secundaria;
                    }else{
                        return "-"
                    }
                }
            },
            //salidas
            {
                data: null,
                render: function (data, type, row) {
                    return data.salidas + ' ' + data.unidad_medida_base;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_conversion != null && data.unidad_medida_secundaria != null){
                        const um2 = data.salidas / data.unidad_conversion
                        return  um2  + ' ' + data.unidad_medida_secundaria;
                    }else{
                        return "-"
                    }
                }
            },

            //stock
            {
                data: null,
                render: function (data, type, row) {
                    return data.stock + ' ' + data.unidad_medida_base;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_conversion != null && data.unidad_medida_secundaria != null){
                        const um2 = data.stock / data.unidad_conversion
                        return  um2  + ' ' + data.unidad_medida_secundaria;
                    }else{
                        return "-"
                    }
                }
            },
            {data: 'precio_compra'},
            {data: 'precio_venta'},
            {data: 'precio_minimo'},
            {data: 'observaciones'},
            {data: 'btn-edit' },
            {data: 'btn-stock'},
        ],
        createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(6)').addClass('color-especial'); 
            $(row).find('td:eq(7)').addClass('color-especial'); 
        }
    });

    $(document).on("click",".btn-class-edit", llenar_campos_edit);
    $(document).on("click","#btn-update", update_fila);

    $(document).on("click",".btn-class-stock", llenar_campo_stock);
    $(document).on("click","#btn-update-stock", update_stock);


    function llenar_campos_edit() {
        $.get('/almacen/fiscal/show/' + $(this).data('id') , function(msg) {
            $.each(msg.data, function (key, value) {
                var variable = "#" + key;
                $(variable).val(value);
            });
        })
        $("#modal-edit").modal("show");
    }

    function update_fila(){
        $.ajax({
            method: "POST",
            url: "update",
            data: $("#form-edit-almacen").serialize()
        }).done(function (msg) {
                mensaje_succes('#modal-edit');
                listtabla.ajax.reload(null,false);
            }).fail(function (jqXHR) {
                mensaje_error('Verifica tus datos!');
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

    function llenar_campo_stock(){
        $.get('/almacen/fiscal/show/' + $(this).data('id') , function(msg) { 
            $('#idAlmacen_stock').val(msg.data.idAlmacen);
        })
        
        $("#modal-edit-stock").modal("show");

    }

    function update_stock(){
        if($("#cantidad_update").val() == "" || $("#insidencia").val() == ""){
            mensaje_error('Favor de rellenar todos los campos');
            return false;
        }

        $.ajax({
            method: "POST",
            url: "/almacen/fiscal/update_stock",
            data: {
                '_token': $('input[name=_token]').val(),
                'idAlmacen': $("#idAlmacen_stock").val(),
                'insidencia': $('#insidencia').val(),
                'cantidad': $('#cantidad_update').val()
                },
        }).done(function (msg) {
            if(msg.mensaje == "success") {
                mensaje_succes('#modal-edit-stock');
                listtabla.ajax.reload(null,false);  
                $('#insidencia').val("");
                $('#cantidad_update').val("");
                $('#idAlmacen_stock').val("");
            }else{
                mensaje_error('No puedes disminuir esta cantidad');
            }
            }).fail(function (jqXHR) {
                mensaje_error('Verifica tus datos!');
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

    function mensaje_error(mensaje) {
        Swal.fire({
            icon: 'error',
            title: "Error",
            text: mensaje,
            width: '20rem',
            // showConfirmButton: true,
        })
    }


});