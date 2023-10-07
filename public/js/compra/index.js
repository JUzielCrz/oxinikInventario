$(document).ready(function () {

    $(document).on("click","#btn-anadir-producto", insertar_producto);
    $(document).on("click","#btn-eliminar-fila", eliminar_fila);

    $(document).on("click","#btn-save-compra", save_compra);

    $("#nav-ico-compra").addClass("active");
    
    $('#provedor').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
            $.ajax({
                method: "POST",
                url:"search_provedor",
                data:{'query':query,'_token': $('input[name=_token]').val(),},
                success:function(data){
                    $('#listar-provedores').fadeIn();  
                    $('#listar-provedores').html(data);

                }
            });
        }
    });
    

    $(document).on('click', '.li-provedor', function(){  
        $('#provedor').val($(this).text());  
        $('#listar-provedores').fadeOut();  
    });  


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
        const product =$(this).text()
        $('#producto').val(product);  
        $('#listar-productos').fadeOut();

        var idProduct = product.split('-');
        $.get('/producto/show/' + idProduct[0] , function(msg) {
            $("#unidad_medida").empty();
            if(msg.data.unidad_medida_secundaria == null){
                $("#unidad_medida").append(
                    '<option value="unidad_medida_base" selected>'+msg.data.unidad_medida_base+'</option>'
                );
            }else{
                $("#unidad_medida").append(
                    '<option value="" disabled selected>Selecciona</option>'+
                    '<option value="unidad_medida_base">'+msg.data.unidad_medida_base+'</option>'+
                    '<option value="unidad_medida_secundaria">'+msg.data.unidad_medida_secundaria+'</option>'
                );
            }
        })

    });  


    $('#subtotal').keyup(function(){ actualizar_campos_totales() });
    $('#iva').keyup(function(){ actualizar_campos_totales() });

    function actualizar_campos_totales(){
        let subtotal = 0;
        let iva=0;
        if($('#iva').val()==""){
             iva = 0;
        }else{
            iva = parseFloat($('#iva').val());
        }
        if($('#subtotal').val()==""){
            subtotal = 0;
       }else{
            subtotal = parseFloat($('#subtotal').val());
       }
        let total = subtotal + iva;

        $('#total').val(total.toFixed(2));
    }
    
    function insertar_producto() {
        var campo= ['producto','cantidad', 'unidad_medida','subtotal', 'total', 'facturado'];
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

            Swal.fire({
                title: '¡Error!',
                text: 'Faltan datos del producto',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })

            return false;
        }

        var iva_product=0;
        if($('#iva').val()==""){
            iva_product=0;
        } else{
            iva_product=$('#iva').val();
        }
        

        $('#tbody-lista-productos').append(
            "<tr class='tr-class-producto'>"+
                "<td>"+$("#producto").val()+"</td><input type='hidden' name='arrProducto[]' value='"+$('#producto').val() +"'></input>"+
                "<td>"+$("#cantidad").val()+"</td><input type='hidden' name='arrCantidad[]' value='"+$('#cantidad').val() +"'></input>"+
                "<td>"+$("#unidad_medida").find('option:selected').text()+"</td><input type='hidden' name='arrUnidadMedida[]' value='"+$('#unidad_medida').val() +"'></input>"+
                "<td>"+$("#subtotal").val()+"</td><input type='hidden' name='arrSubTotal[]' value='"+$('#subtotal').val() +"'></input>"+
                "<td>"+iva_product+"</td><input type='hidden' name='arrIva[]' value='"+iva_product +"'></input>"+
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
            var precio_producto=$(this).find("td")[5].innerHTML;
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

    function save_compra(){
        var campo= ['provedor','folio','tipo_folio','fecha'];
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

            Swal.fire({
                title: '¡Error!',
                text: 'Faltan datos de compra',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })

            return false;
        }

        var folio= $('#folio').val().replace(/ /g,'');

        Swal.fire({
            icon: 'question',
            title: 'Seguro que deseas continuar?',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    method: "post",
                    url: "/compra/save",
                    data: $("#form-compra").serialize(), 
                }).done(function(msg){
                        Swal.fire('¡Guardado!', '', 'success')
                        limpiar_campos_compra();
                        $("#tbody-lista-productos").empty();
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

    function limpiar_campos_producto(){
        $("#producto").val('')
        $("#cantidad").val('')
        $("#subtotal").val('')
        $("#iva").val('')
        $("#total").val('')
        $("#facturado").val('')
        $("#unidad_medida").empty();
    }
    function limpiar_campos_compra(){
        $("#provedor").val('')
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