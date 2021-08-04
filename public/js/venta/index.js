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

    
    function insertar_producto() {
        var campo= ['producto','cantidad','subtotal','iva', 'total', 'facturado'];
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

        

        $('#tbody-lista-productos').append(
            "<tr>"+
                "<td>"+$("#producto").val()+"</td><input type='hidden' name='arrProducto[]' value='"+$('#producto').val() +"'></input>"+
                "<td>"+$("#cantidad").val()+"</td><input type='hidden' name='arrCantidad[]' value='"+$('#cantidad').val() +"'></input>"+
                "<td>"+$("#subtotal").val()+"</td><input type='hidden' name='arrSubTotal[]' value='"+$('#subtotal').val() +"'></input>"+
                "<td>"+$("#iva").val()+"</td><input type='hidden' name='arrIva[]' value='"+$('#iva').val() +"'></input>"+
                "<td>"+$("#total").val()+"</td><input type='hidden' name='arrTotal[]' value='"+$('#total').val() +"'></input>"+
                "<td>"+$("#facturado").val()+"</td><input type='hidden' name='arrFacturado[]' value='"+$('#facturado').val() +"'></input>"+
                "<td>"+ "<button type='button' class='btn btn-naranja' id='btn-eliminar-fila'><span class='fas fa-window-close'></span></button>" +"</td>"+
            "</tr>"
        );

        
    }

    
    function eliminar_fila(){
        $(this).closest('tr').remove();
    }

    function save_venta(){
        var campo= ['provedor','folio_factura','fecha'];
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
                text: 'Faltan datos de vente',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })

            return false;
        }

        var folio_factura= $('#folio_factura').val().replace(/ /g,'');

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
                    url: "/venta/save",
                    data: $("#form-venta").serialize(), 
                }).done(function(msg){
                        Swal.fire('¡Guardado!', '', 'success')
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