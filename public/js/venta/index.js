$(document).ready(function () {
    //Objetos:

    var objProducto = new Object();

    $("#nav-ico-venta").addClass("active");

    $(document).on("click","#btn-anadir-producto", insertarProducto);
    $(document).on("click",".btn-eliminar-fila", eliminarFila);
    $(document).on("click","#btn-save-venta", guardarVenta);


     //para buscar cliente
     $('#cliente').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
            $.ajax({
                method: "POST",
                url:"search_cliente",
                data:{'query':query,'_token': $('input[name=_token]').val(),},
                success:function(data){
                    $('#listar-clientes').fadeIn();  
                    $('#listar-clientes').html(data);

                }
            });
        }
    });

    $(document).on('click', '.li-cliente', function(){  
        $('#cliente').val($(this).text());  
        $('#listar-clientes').fadeOut();  
    });  

    //buscar producto
    $('#producto').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
            $.ajax({
                method: "POST",
                url:"search_producto",
                data:{'query':query,'_token': $('input[name=_token]').val(),},
                success:function(data){
                    $('#listar-productos').fadeIn();  
                    $('#listar-productos').html(data);

                }
            });
        }
    });

    //Selecciona producto
    $(document).on('click', '.li-producto', function() {
        const product = $(this).text();
        $('#producto').val(product);
        $('#listar-productos').fadeOut();
    
        const idProduct = product.split('-');
        obtenerDatosProducto(idProduct[0]);
    });

    //obtener datos producto
    function obtenerDatosProducto(idProducto) {
        $.get(`/producto/show/${idProducto}`, function(msg) {
            if (msg) {
                actualizarObjetoProducto(msg.data);
                rellenarCampos();
            } else {
                console.error('Error al obtener datos del producto:', msg.message);
            }
        }).fail(function() {
            console.error('Error en la solicitud AJAX');
        });
    }
    
    function actualizarObjetoProducto(data) {
        objProducto.nombre = data.nombre;
        objProducto.precio_minimo = data.precio_minimo;
        objProducto.precio_venta = data.precio_venta;
        objProducto.unidad_medida_base = data.unidad_medida_base;
        objProducto.unidad_medida_secundaria = data.unidad_medida_secundaria;
        objProducto.unidad_conversion = data.unidad_conversion;
    }
    
    //Rellenar Campos en inputs de producto
    function rellenarCampos() {
        const unidadMedidaSelect = document.getElementById("unidad_medida");
    
        unidadMedidaSelect.innerHTML = `<option value="unidad_medida_base">${objProducto.unidad_medida_base}</option>`;
        if (objProducto.unidad_medida_secundaria !== null) {
            unidadMedidaSelect.innerHTML += `<option value="unidad_medida_secundaria">${objProducto.unidad_medida_secundaria}</option>`;
        }
    }
    
    // si cuando el usuario rellena algun campo manualmente
    $('#subtotal').keyup(function(){ 
        var subtotal = ($('#subtotal').val() === "") ? 0 : parseFloat($('#subtotal').val());
        let iva = subtotal*0.16;
        $('#iva').val(iva.toFixed(2))
        let total = subtotal + iva;
        $('#total').val(total.toFixed(2));
    });
    $('#iva').keyup(function(){ 
        var subtotal = ($('#subtotal').val() === "") ? 0 : parseFloat($('#subtotal').val());
        let iva = ($('#iva').val() === "") ? 0 : parseFloat($('#iva').val());
        let total = subtotal + iva;
        $('#total').val(total.toFixed(2));
     });

    //Insertar producto
    function insertarProducto() {
        limpiarMensajesError();
        
        const producto = $("#producto").val();
        const cantidad = parseFloat($("#cantidad").val());
        const subtotal = parseFloat($("#subtotal").val());
        const iva = parseFloat($("#iva").val());
        const facturado = $("#facturado option:selected").val();
    
        if (!validarCampo(producto, "producto")) return false;
        if (!validarCantidad(cantidad, "cantidad")) return false;
        if (!validarNumeroNoNegativo(subtotal, "subtotal")) return false;
        if (!validarNumeroNoNegativo(iva, "iva")) return false;
        if (!validarCampo(facturado, "facturado")) return false;
        
        if ($(`.tr-class-producto:contains(${producto})`).length > 0) {
            mensajeError('Este producto ya está en la lista');
            return false;
        }
    
        agregarFilaProducto(producto, cantidad, subtotal, iva, facturado);
        actualizarTotalGeneral();
        limpiarCamposProducto();
    }
    
    function validarCampo(valor, campo) {
        if (valor === "") {
            $(`#${campo}`).addClass('is-invalid');
            $(`#${campo}Error`).text('Necesario');
            return false;
        }
        return true;
    }
    
    function validarCantidad(valor, campo) {
        if (isNaN(valor) || valor <= 0) {
            $(`#${campo}`).addClass('is-invalid');
            $(`#${campo}Error`).text('Necesario');
            return false;
        }
        return true;
    }
    
    function validarNumeroNoNegativo(valor, campo) {
        if (isNaN(valor) || valor < 0) {
            $(`#${campo}`).addClass('is-invalid');
            $(`#${campo}Error`).text('Necesario');
            return false;
        }
        return true;
    }
    
    function limpiarMensajesError() {
        $('#productoError, #cantidadError, #subtotalError, #ivaError, #facturadoError').empty();
        $('#producto, #cantidad, #subtotal, #iva, #facturado').removeClass('is-invalid');
    }
    
    function agregarFilaProducto(producto, cantidad, subtotal, iva, facturado) {
        const unidadMedida = $("#unidad_medida").val();
        const unidadMedidaTexto = $("#unidad_medida option:selected").text();
        $('#tbody-lista-productos').append(
            `<tr class='tr-class-producto'>
                <td>${producto}<input type='hidden' name='arrProducto[]' value='${producto}'></input></td>
                <td>${cantidad}<input type='hidden' name='arrCantidad[]' value='${cantidad}'></input></td>
                <td>${unidadMedidaTexto}
                    <input type='hidden' name='arrUnidadMedida[]' value='${unidadMedida}'></input>
                    <input type='hidden' name='arrUnidadMedidaTexto[]' value='${unidadMedidaTexto}'></input>
                </td>
                <td>${subtotal}<input type='hidden' name='arrSubTotal[]' value='${subtotal}'></input></td>
                <td>${iva}<input type='hidden' name='arrIva[]' value='${iva}'></input></td>
                <td>${subtotal + iva}<input type='hidden' name='arrTotal[]' value='${subtotal + iva}'></input></td>
                <td>${facturado}<input type='hidden' name='arrFacturado[]' value='${facturado}'></input></td>
                <td><button type='button' class='btn btn-naranja btn-eliminar-fila'><span class='fas fa-window-close'></span></button></td>
            </tr>`
        );
    }
    
    function limpiarCamposProducto() {
        $("#producto, #cantidad, #precio_unitario, #subtotal, #iva, #total, #facturado, #unidad_medida").val('')
        $("#unidad_medida").empty()
    }

    function actualizarTotalGeneral() {
        let sumTotales = 0;
    
        $(".tr-class-producto").each(function() {
            const precioProducto = parseFloat($(this).find("td")[5].innerHTML);
            sumTotales += isNaN(precioProducto) ? 0 : precioProducto;
        });
    
        $('#h5-total-general').replaceWith(
            `<h5 id="h5-total-general">Total: $ ${Intl.NumberFormat('es-MX').format(sumTotales)}</h5>`
        );
    
        $('#total_general').val(sumTotales);
    }
    
    function eliminarFila() {
        $(this).closest('tr').remove();
        actualizarTotalGeneral();
    }


    function guardarVenta() {
        limpiarMensajesError();
    
        if (!validarCamposVenta()) {
            mensajeError('Faltan datos de venta');
            return false;
        }
    
        confirmarGuardarVenta().then((result) => {
            if (result.isConfirmed) {
                enviarDatosVenta();
            }
        });
    }
    
    function validarCamposVenta() {
        const campos = ['cliente', 'folio', 'tipo_folio', 'fecha'];
        let camposVacios = false;
    
        campos.forEach((campo) => {
            $(`#${campo}Error`).empty();
            $(`#${campo}`).removeClass('is-invalid');
    
            if ($(`#${campo}`).val() === '' || $(`#${campo}`).val() <= 0) {
                $(`#${campo}`).addClass('is-invalid');
                $(`#${campo}Error`).text('Necesario');
                camposVacios = true;
            }
        });
    
        return !camposVacios;
    }
    
    function confirmarGuardarVenta() {
        return Swal.fire({
            icon: 'question',
            title: 'Seguro que deseas continuar?',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
        });
    }
    
    function enviarDatosVenta() {
        $.ajax({
            method: "post",
            url: "/venta/save",
            data: $("#form-venta").serialize(),
        })
        .then((msg) => {
            if (msg.mensaje === 'success') {
                Swal.fire('¡Guardado!', '', 'success');
                limpiarCamposVenta();
                $("#tbody-lista-productos").empty();
            } else {
                mensajeError(msg.mensaje);
            }
        })
        .catch((jqXHR) => {
            Swal.fire('Verifica tus datos!', '', 'error');
    
            if (jqXHR.status === 422) {
                $.each(jqXHR.responseJSON.errors, function (key, value) {
                    const idError = `#${key}Error`;
                    $(idError).text(value);
                });
            }
        });
    }
    
    function limpiarCamposVenta() {
        $("#cliente, #tipo_folio, #folio, #fecha, #total_general").val('');
        $('#h5-total-general').replaceWith(
            '<h5 id="h5-total-general">Total: $ 0.0</h5>'
        );
    }
    
    function limpiarMensajesError() {
        $('#clienteError, #folioError, #tipo_folioError, #fechaError').empty();
        $('#cliente, #folio, #tipo_folio, #fecha').removeClass('is-invalid');
    }


    function mensajeError(mensaje){
        Swal.fire({
            title: '¡Error!',
            text: mensaje,
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    }

    $('.numero-entero-positivo').keypress(function (event) {
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