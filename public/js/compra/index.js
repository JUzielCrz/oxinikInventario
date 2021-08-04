$(document).ready(function () {

    $(document).on("click","#btn-anadir-producto", insertar_producto);
    $(document).on("click","#btn-eliminar-fila", eliminar_fila);

    $(document).on("click","#btn-save-compra", save_compra);


    $("#nav-ico-compra").addClass("active");
    function insertar_producto() {
        

        var campo= ['folio_factura','fecha','provedor','cantidad','producto','subtotal','iva', 'total'];
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
                text: 'Faltan datos en el formulario',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })

            return false;
        }

        var folio_factura= $('#folio_factura').val().replace(/ /g,'');

        $('#tbody-lista-productos').append(
            "<tr>"+
                "<td>"+$("#folio_factura").val()+"</td><input type='hidden' name='arrfolio_factura[]' value='"+$('#folio_factura').val() +"'></input>"+
                "<td>"+$("#fecha").val()+"</td><input type='hidden' name='arrfecha[]' value='"+$('#fecha').val() +"'></input>"+
                "<td>"+$("#provedor").val()+"</td><input type='hidden' name='arrProvedor[]' value='"+$('#provedor').val() +"'></input>"+
                "<td>"+$("#cantidad").val()+"</td><input type='hidden' name='arrCantidad[]' value='"+$('#cantidad').val() +"'></input>"+
                "<td>"+$("#producto").val()+"</td><input type='hidden' name='arrProducto[]' value='"+$('#producto').val() +"'></input>"+
                "<td>"+$("#subtotal").val()+"</td><input type='hidden' name='arrsubTotal[]' value='"+$('#subtotal').val() +"'></input>"+
                "<td>"+$("#iva").val()+"</td><input type='hidden' name='arrIva[]' value='"+$('#iva').val() +"'></input>"+
                "<td>"+$("#total").val()+"</td><input type='hidden' name='arrTotal[]' value='"+$('#total').val() +"'></input>"+
                "<td>"+ "<button type='button' class='btn btn-naranja' id='btn-eliminar-fila'><span class='fas fa-window-close'></span></button>" +"</td>"+
            "</tr>"
        );

        
    }

    
    function eliminar_fila(){
        $(this).closest('tr').remove();
    }

    function save_compra(){

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
                }).done(function(){
                    Swal.fire('Guardado!', '', 'success')
                }).fail(function (jqXHR, textStatus) {
                    //Si existe algun error entra aqui
                    Swal.fire('Verifica tus datos!', '', 'error')

                    mostrar_mensaje("#divmsgnota",'Error, Verifica tus datos', "alert-danger",null);
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