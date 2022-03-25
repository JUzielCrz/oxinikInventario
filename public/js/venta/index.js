$(document).ready(function () {
    $("#nav-ico-venta").addClass("active");

    $(document).on("click","#btn-anadir-producto", insertar_producto);
    $(document).on("click","#btn-eliminar-fila", eliminar_fila);

    $(document).on("click","#btn-save-venta", save_venta);


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

    $(document).on('click', '.li-producto', function(){  
        $('#producto').val($(this).text());  
        $('#listar-productos').fadeOut();  
    });  

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

    
    function insertar_producto() {
        $('#productoError').empty();
        $('#cantidadError').empty();
        $('#subtotalError').empty();
        $('#ivaError').empty();
        $('#facturadoError').empty();

        $('#producto').removeClass('is-invalid');
        $('#cantidad').removeClass('is-invalid');
        $('#subtotal').removeClass('is-invalid');
        $('#iva').removeClass('is-invalid');
        $('#facturado').removeClass('is-invalid');

        if($("#producto").val() == ''){
            $("#producto").addClass('is-invalid');
            $("#productoError").text('Necesario');
            return false;
        }
        if($("#cantidad").val() <=0){
            $("#cantidad").addClass('is-invalid');
            $("#cantidadError").text('Necesario');
            return false;
        }
        if($("#subtotal").val() < 0){
            $("#subtotal").addClass('is-invalid');
            $("#subtotalError").text('Necesario');
            return false;
        }
        if($("#iva").val() < 0){
            $("#iva").addClass('is-invalid');
            $("#ivaError").text('Necesario');
            return false;
        }
        if($("#facturado").val() == ''){
            $("#facturado").addClass('is-invalid');
            $("#facturadoError").text('Necesario');
            return false;
        }
        
        var boolRepetido=false;
        $(".tr-class-producto").each(function(index, value){
            var valores = $(this).find("td")[0].innerHTML;
            if(valores == $("#producto").val()){
                boolRepetido=true;
            }
        })

        if(boolRepetido){
            mensaje_error('Este producto ya esta agregado a la lista');
            return false;
        }

        $('#tbody-lista-productos').append(
            "<tr class='tr-class-producto'>"+
                "<td>"+$("#producto").val()+"</td><input type='hidden' name='arrProducto[]' value='"+$('#producto').val() +"'></input>"+
                "<td class='text-center'>"+"<input type='number' name='arrCantidad[]' value='"+$('#cantidad').val() +"' id='arrCantidad' class='form-control form-control-sm numero-entero-positivo' style='width:10rem' ></input>"+"</td>"+
                "<td>"+$("#subtotal").val()+"</td><input type='hidden' name='arrSubTotal[]' value='"+$('#subtotal').val() +"'></input>"+
                "<td>"+$("#iva").val()+"</td><input type='hidden' name='arrIva[]' value='"+$('#iva').val() +"'></input>"+
                "<td>"+$("#total").val()+"</td><input type='hidden' name='arrTotal[]' value='"+$('#total').val() +"'></input>"+
                "<td>"+$("#facturado").val()+"</td><input type='hidden' name='arrFacturado[]' value='"+$('#facturado').val() +"'></input>"+
                "<td>"+ "<button type='button' class='btn btn-naranja' id='btn-eliminar-fila'><span class='fas fa-window-close'></span></button>" +"</td>"+
            "</tr>"
        );
        actualizarTotal();
        limpiar_campos_producto();
        
    }

    function actualizarTotal(){
        var sum_totales = 0;

        $(".tr-class-producto").each(function(){
            var precio_producto=$(this).find("td")[4].innerHTML;
            sum_totales=sum_totales+parseFloat(precio_producto);
        })
        $('#h5-total-general').replaceWith(
            '<h5 id="h5-total-general">Total: $ '+Intl.NumberFormat('es-MX').format(sum_totales)+'</h5>'
        );
        $('#total_general').val(sum_totales)
    }

    function eliminar_fila(){
        $(this).closest('tr').remove();
        actualizarTotal();
    }

    function save_venta(){

        var campo= ['cliente','folio','tipo_folio','fecha'];
        var campovacio = [];

        $.each(campo, function(index){
            $('#'+campo[index]+'Error').empty();
            $('#'+campo[index]).removeClass('is-invalid');
        });

        $.each(campo, function(index){
            if($("#"+campo[index]).val()=='' || $("#"+campo[index]).val()<=0    ){
                campovacio.push(campo[index]);
            }
        });

        if(campovacio.length != 0){
            $.each(campovacio, function(index){
                $("#"+campovacio[index]).addClass('is-invalid');
                $("#"+campovacio[index]+'Error').text('Necesario');
            });

            mensaje_error('Faltan datos de venta');

            return false;
        }

        // var folio= $('#folio').val().replace(/ /g,'');
        
        Swal.fire({
            icon: 'question',
            title: 'Seguro que deseas continuar?',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
        }).then((result) => {
            
            
            if (result.isConfirmed) {
                $.ajax({
                    method: "post",
                    url: "/venta/save",
                    data: $("#form-venta").serialize(), 
                }).done(function(msg){
                    if(msg.mensaje =='success'){
                        Swal.fire('¡Guardado!', '', 'success')
                        limpiar_campos_venta();
                        $("#tbody-lista-productos").empty();
                    }else{
                        mensaje_error(msg.mensaje);
                    }
                    
                        
                }).fail(function (jqXHR, textStatus) {
                    //Si existe algun error entra aqui
                    Swal.fire('Verifica tus datos!', '', 'error')

                    var status = jqXHR.status;
                    if (status === 422) {
                        $.each(jqXHR.responseJSON.errors, function (key, value) {
                            var idError = "#" + key + "Error";
                            //$(idError).removeClass("d-none");
                            $(idError).text(value);
                        });
                    }
                });
                
            } 
        })

        
    }

    function mensaje_error(mensaje){
        Swal.fire({
            title: '¡Error!',
            text: mensaje,
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    }
    function limpiar_campos_producto(){
        $("#producto").val('')
        $("#cantidad").val('')
        $("#subtotal").val('')
        $("#iva").val('')
        $("#total").val('')
        $("#facturado").val('')
    }
    function limpiar_campos_venta(){
        $("#cliente").val('')
        $("#tipo_folio").val('')
        $("#folio").val('')
        $("#fecha").val('')
        $("#total_general").val(0)
        $('#h5-total-general').replaceWith(
            '<h5 id="h5-total-general">Total: $ 0.0</h5>'
        );
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