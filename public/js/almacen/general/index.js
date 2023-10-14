$(document).ready(function () {

    $("#nav-ico-almacen").addClass("active");
    

    var listtabla = $('#table-data-almacen').DataTable({
        language: {"url": "/js/language_dt_spanish.json"},
        processing: true,
        serverSider: true,
        ajax: '/almacen/general/data',
        columns:[
            {data: 'nombre'},
            {data: 'clave_sat'},
            //INICIAL
            {
                data: null,
                render: function (data, type, row) {
                    return data.inicial + ' ' + data.unidad_medida_base;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_conversion != null && data.unidad_medida_secundaria != null){
                        const um2 = data.inicial / data.unidad_conversion
                        return  um2  + ' ' + data.unidad_medida_secundaria;
                    }else{
                        return "-"
                    }
                }
            },
            
            //ENTRADAS
            {
                data: null,
                render: function (data, type, row) {
                    return data.sumEntradas + ' ' + data.unidad_medida_base;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_conversion != null && data.unidad_medida_secundaria != null){
                        const um2 = data.sumEntradas / data.unidad_conversion
                        return  um2  + ' ' + data.unidad_medida_secundaria;
                    }else{
                        return "-"
                    }
                }
            },

            //SalidasAS
            {
                data: null,
                render: function (data, type, row) {
                    return data.sumSalidas + ' ' + data.unidad_medida_base;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_conversion != null && data.unidad_medida_secundaria != null){
                        const um2 = data.sumSalidas / data.unidad_conversion
                        return  um2  + ' ' + data.unidad_medida_secundaria;
                    }else{
                        return "-"
                    }
                }
            },

            //sumStock
            {
                data: null,
                render: function (data, type, row) {
                    return data.sumStock + ' ' + data.unidad_medida_base;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    if(data.unidad_conversion != null && data.unidad_medida_secundaria != null){
                        const um2 = data.sumStock / data.unidad_conversion
                        return  um2  + ' ' + data.unidad_medida_secundaria;
                    }else{
                        return "-"
                    }
                }
            },

            {data: 'precio_compra'},
            {data: 'precio_venta'},
            {data: 'precio_minimo'},
        ],
        createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(8)').addClass('color-especial'); 
            $(row).find('td:eq(9)').addClass('color-especial'); 
        }
    });

    
});