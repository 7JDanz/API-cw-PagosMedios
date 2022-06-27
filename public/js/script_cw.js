$(document).ready(function(){

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

    });



    var result = '';
    var current = new Date();

    $("#exampleFormControlSelect1 option[value='"+(current.getMonth()+1)+"']").attr("selected","selected") ;
    $("#pagar").prop( "disabled", true );
    fn_setValues();
    fn_randomImage();

    let searchParams = new URLSearchParams(window.location.search);
    let codigo = 'codigo';
    if(searchParams.has(codigo)){
        let param = searchParams.get(codigo);
        $("#identificacion").val(param);
        fn_buscarEstudiante();
    }

    });

    $('.form-selectRadio :input').focus(function(){
    if(this.id=='option1'){
    $('#selectMes').show();
    fn_setValues();
    }else{
    $('#selectMes').hide();
    fn_setValues();
    }
    });

    $("#btn-buscar").click(function(e){
    e.preventDefault();
    fn_buscarEstudiante();

    });

    $('#pagar').click(function(e){
        e.preventDefault();
        if(result){
        send = {
            data :  result,
            codigo: $('#identificacion').val()
        }

        $.ajax({
            type:    'POST',
            url:     '/redirigir/pago',
            data:    send,
            success: function(datos){
                datos = JSON.parse(datos);
                window.location.replace(datos.data.url);

            },
            statusCode: {
            404: function() {
                alert('web not found');
            }
            },
            error:function(x,xs,xt){
                //nos dara el error si es que hay alguno
                window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
            }
            });
        }else{

        }
    });

    function fn_buscarEstudiante(){
        //1:Pension;2:Matricula
    var concepto        = $("input[name='options']:checked").val();
    var identificacion  = $('#identificacion').val();
    var mes             = $('#exampleFormControlSelect1').val();
    var send            = {
    identificacion  : identificacion,
    concepto        : concepto,
    mes             : mes
    };

    $.ajax({
    type:    'POST',
    url:     '/buscar/persona',
    data:    send,
    success: function(data){

        $('#nombre_respresentante').text(data[0]['datos'][0].representante_nombres + ' ' +data[0]['datos'][0].representante_apellidos);

        //sessionStorage
        //sessionStorage.setItem('payload', JSON.stringify(data));

        //formulario
        $("#inputName").val(data[0]['datos'][0].representante_nombres);
        $("#inputLast_Name").val(data[0]['datos'][0].representante_apellidos);
        $("#inputAddress").val(data[0]['datos'][0].representante_direccion);
        $("#inputPhone").val(data[0]['datos'][0].representante_telefono);
        $("#inputEmail").val(data[0]['datos'][0].representante_email);

        //Tabla
        $('#datos_factura').html('<tr>'+
                                    '<td>1</td>'+
                                    '<td>'+data[0]['concepto'][0].descripcion+' Mes '+$("#exampleFormControlSelect1 option:selected" ).text()+'</td>'+
                                    '<td>'+data[0]['datos'][0].estudiante_nombres+' '+data[0]['datos'][0].estudiante_apellidos+'</td>'+
                                    '<td>'+data[0]['datos'][0].matricula_grado_id+'</td>'+
                                    '</tr>');
        //Descuento
        if(data[0]['descuento'].length == 0){
            descripcion = '';
            descuento = 0;
            total = parseFloat(data[0]['concepto'][0].valor).toFixed(2);
        }else{
            descripcion = data[0]['descuento'][0].descripcion;
            descuento = data[0]['descuento'][0].valor_descuento;
            total = parseFloat(data[0]['descuento'][0].total).toFixed(2);
        }

        $('#detalle_factura').empty();
        $('#detalle_factura').html(
            '<tr>'+'<td>Subtotal 12%</td><td>'+0+'</td>'+'</tr>'+
            '<tr>'+'<td>Subtotal 0%</td><td>'+parseFloat(data[0]['concepto'][0].valor).toFixed(2)+'</td>'+'</tr>'+
            '<tr>'+'<td>Descuento: <small>'+descripcion+'</small></td><td>'+descuento+'</td>'+'</tr>'+
            '<tr>'+'<td><h6>Total</h6></td><td>'+total+'</td>'+'</tr>'
        );

        result = JSON.stringify(data);
        $('#valor').text(total);
        $("#pagar").prop( "disabled", false );
    },
    statusCode: {
    404: function() {
        alert('web not found');
    }
    },
    error:function(x,xs,xt){
        //nos dara el error si es que hay alguno
        window.open(JSON.stringify(x));
        //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
    }
    });

    }

    function fn_setValues(){
        $('#nombre_respresentante').text('');

        //formulario
        $("#inputName").val('');
        $("#inputLast_Name").val('');
        $("#inputAddress").val('');
        $("#inputPhone").val('');
        $("#inputEmail").val('');

        //Tabla
        $('#datos_factura').empty();

        $('#detalle_factura').empty();
        $('#detalle_factura').html(
            '<tr>'+'<td>Subtotal 12%</td><td>'+0+'</td>'+'</tr>'+
            '<tr>'+'<td>Subtotal 0%</td><td>'+0+'</td>'+'</tr>'+
            '<tr>'+'<td>Descuento:</td><td>'+0+'</td>'+'</tr>'+
            '<tr>'+'<td><h6>Total</h6></td><td>'+0+'</td>'+'</tr>'
        );

        $('#valor').text('');
        $("#pagar").prop( "disabled", true );
    }

    function fn_randomImage(){

            var random= Math.floor(Math.random() * 5) + 0;
            var bigSize = ["url('../images/0.jpg')",
                           "url('../images/1.jpg')",
                           "url('../images/2.jpg')",
                           "url('../images/3.jpg')",
                           "url('../images/4.jpg')"];
            document.getElementById("bg-image").style.backgroundImage=bigSize[random];
    }
