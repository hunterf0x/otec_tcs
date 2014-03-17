$(document).ready(function(){
    loadClip();

   // loadChart();
   // $("#chart").UseTooltip();


    $('.selectpicker').selectpicker({
        'selectedText': 'cat'
    });

    $(".datepicker").datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        autoclose: true,
        language: "es"
    })
    .on("changeDate",function(event){
        var fecha=event.date.getUTCFullYear()+"-"+(event.date.getUTCMonth()+1)+"-"+event.date.getUTCDate();
        $(this).next("input:hidden").val(fecha);
    })


    $(".input-daterange")
        .datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1,
            startDate:"+1d",
            endDate: "+1m",
            autoclose: true,
            todayHighlight: true,
            language: "es"
        })

    $('#cargar_dias').on('click',function(){
        var fi,ft;
        fi = $('#finicio').val();
        ft = $('#ftermino').val();
        fi = fi.split("/");
        ft = ft.split("/");
        $('#seleccionDias').html('');
        $('#seleccionSemanas').html('');
        seleccionDias(fi,ft);
        $('.semana').eq(0).fadeIn();
        seleccionSemanas();


    })

    function seleccionDias(fi,ft){
        var finicio,ftermino,tiempo, tmp_inicio, cnt= 0, tag_inicio, tag_cierre,semana;


        finicio = new Date(fi[2],fi[1]-1,[fi[0]]);
        ftermino = new Date(ft[2],ft[1]-1,[ft[0]]);
        tmp_inicio = finicio;

        //tiempo = ftermino.getTime() - finicio.getTime();
        //var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));

        tag_inicio = '<div class="semana">';
        tag_cierre = '</div>';

        while( tmp_inicio <= ftermino){

            if(tmp_inicio == finicio){
                if(tmp_inicio.getDay()==0){
                    semana = tag_inicio+ renderDia(tmp_inicio) + tag_cierre;
                }else{
                    semana = tag_inicio+ renderDia(tmp_inicio);
                }


            }else{
                if(tmp_inicio == ftermino){
                    semana = semana + renderDia(tmp_inicio) + tag_cierre;

                }else if(tmp_inicio.getDay()==1){
                    semana = semana + tag_inicio + renderDia(tmp_inicio);
                }else if(tmp_inicio.getDay()==0){
                    semana = semana + renderDia(tmp_inicio)+ tag_cierre;
                }else{
                    semana = semana + renderDia(tmp_inicio);
                }
            }


            //renderDia(tmp_inicio);

            var newDate = tmp_inicio.setDate(tmp_inicio.getDate() + 1);
            tmp_inicio = new Date(newDate);

        }


         $(document).on( "myCustomEvent", function( event, myName ) {
            $('.timepicker').timepicker({
                defaultTime: '10:00 AM',
                minuteStep: 5
            });
         })
         $('#seleccionDias').append(semana);
         $('.timepicker').trigger( "myCustomEvent" );

    }

    function seleccionSemanas(){
        var html = '<ul class="nav nav-pills">';
        var semanas = $('.semana').length;
        for(var i= 1; i<=semanas; i++){
            var sem = i -1;
            html = html + '<li><a class="abreSemana" data-semana="'+sem+'">semana'+i+'</a></li>';
        }
        html = html + '</ul>';
        $('#seleccionSemanas').append(html);
    }

    function renderDia(dia){
        var     days = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sábado'],html;

        html = '<div class="control-group">' +
            '<label class="control-label">'+days[dia.getDay()]+'</label>' +
            '<div class="controls"><input type="checkbox" name="dias[0]" value="'+days[dia.getDay()].substr(0,3)+'" class="check_dias">' +
            '<div class="input-append bootstrap-timepicker">' +
            '<input class="timepicker" name="hora[]" type="text" class="input-small">' +
            '<span class="add-on"><i class="icon-time"></i></span>' +
            '</div>&nbsp;&nbsp;&nbsp;Nº de horas' +
            '<select name="horas[]" class="input-small">' +
            '<option value="">0</option>';
            for(var i=1;i<=10;i++)
                html = html + '<option value="'+i+'">'+i+'</option>';
            html = html +'</select>' +
            '</div>' +
            '</div>';

        return html;

        //console.log(days[dia.getDay()]);
    }

    $('.timepicker').timepicker({
        defaultTime: '10:00 AM',
        minuteStep: 5
    });

    $('.abreSemana').live('click',function(e){

        var id = $(this).data('semana');
        $('.semana').fadeOut().delay( 200 ).eq(id).fadeIn();
    })

    
    $('#uploader_producto').fineUploader({
        multiple: false,
        request: {
            endpoint: site_url+'admin/uploader/producto'
        },
        text: {
            uploadButton: 'Click or Drop'
        }
    }).on('complete', function(event, id, fileName, responseJSON) {
        if (responseJSON.success) {
            var elem = $(this);
            elem.closest("form").find("input[name=imagen]").val(responseJSON.uploadName);
            elem.next().html('<img src="'+site_url+'uploads/clientes/thumbs/'+responseJSON.uploadName+'" class="img-polaroid" alt="' + fileName + '">');
        }
    });






    $('#uploader_slide').fineUploader({
        multiple: false,
        request: {
            endpoint: site_url+'admin/uploader/slide'
        },
        text: {
            uploadButton: 'Click or Drop'
        }
    }).on('complete', function(event, id, fileName, responseJSON) {
            if (responseJSON.success) {
                var elem = $(this);
                elem.closest("form").find("input[name=imagen]").val(responseJSON.uploadName);
                elem.next().html('<img src="'+site_url+'uploads/slides/thumbs/'+responseJSON.uploadName+'" class="img-polaroid" alt="' + fileName + '">');
            }
        });


    
    $('#msje').on('change', function(event){
        var valor = event.target.value;
        if (!event.target.selectedIndex==0)
            $('textarea').val(valor);
        else
            $('textarea').val('');
        })
    
    $('select[name="region_codigo"]').on('change', function(event){
        
    var codigo = $(this).attr('value');
    
    var region_nombre = $(this).find('option:selected').html();
    $('#region').val(region_nombre);
    $('select[name="comuna_codigo"]').empty();
    $.ajax({
        type:'GET',
          dataType: "jsonp",
          url: 'http://apis.modernizacion.cl/dpa/regiones/'+codigo+'/comunas',
          success: function(data){
              $.each(data, function(key, val) {
                  $('select[name="comuna_codigo"]').append('<option value='+ val.codigo +'>' + val.nombre + '</option>');
                  if(key==0){
                      $('input[name="comuna_nombre"]').val(val.nombre);
                  }

            });
        }
    });
  });

  $('select[name="comuna_codigo"]').on('change', function(event){
    var comuna_name =  $(this).find('option:selected').html();
    $('#comuna').val(comuna_name);
  })
    
    //formateo de rut mientras se escribe
    if(jQuery().Rut){
        $('input[name="rut"]').Rut({
            format_on: 'keyup'
        })
    }



    if ( jQuery.isFunction($.fn.tagsManager) ) {

        var segment_str = window.location.pathname; // return segment1/segment2/segment3/segment4
        var segment_array = segment_str.split( '/' );
        var last_segment = segment_array[segment_array.length - 1];



        jQuery(".tm-input").tagsManager({
            prefilled: getValores(),
            typeahead: true,
            typeaheadSource:getAllValores(),
            typeaheadAjaxPolling: true,
            blinkBGColor_1: '#FFFF9C',
            blinkBGColor_2: '#CDE69C',

        });





        function getValores(){
            var res;
            $.ajax({
                type:'GET',
                dataType: "json",
                url: site_url+'admin/clientes/tags/'+last_segment,
                async: false,
                success: function(data){
                    res = data;

                }
            })
            return res;
        }

        function getAllValores(){
            var res;
            $.ajax({
                type:'GET',
                dataType: "json",
                url: site_url+'admin/clientes/tags/',
                async: false,
                success: function(data){
                    res = data;

                }
            })
            return res;
        }



    };
    
    
$('.tip-top').on('click', function(event){
	$('.hide-fav').delay(300).slideToggle(500)
});

    $('#lista_productos tbody tr td a ').click(function(e) {
        $('#imagen_modal img').attr('src', $(this).attr('data-img-url'));
    });
    
    
    
    
    
});


function loadChart(){
    var opcion;
    var data1 = getCompras(2);
    var data2 = getCompras(1);


    function getCompras(opcion){
        var res;
        $.ajax({
            type:'GET',
            dataType: "json",
            url: site_url+'admin/pedidos/compras/'+opcion,
            async: false,
            success: function(data){
                res = data;


            }
        })
        return res;
    }

    var dataset = [
        {
            label: "Compras fallidas",
            data: data1,
            xaxis:2,
            color: "#FF0000",
            points: { fillColor: "#FF0000", show: true },
            lines: { show: true }
        },
        {
            label: "Compras exitosas",
            data: data2,
            xaxis:2,
            color: "#0062E3",
            points: { fillColor: "#0062E3", show: true },
            lines: { show: true }
        }
    ];

    var dayOfWeek = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];

    var options = {
        series: {
            shadowSize: 5
        },
        xaxes: [{
            mode: "time",
            tickFormatter: function (val, axis) {
                return dayOfWeek[new Date(val).getDay()];
            },
            color: "black",
            position: "top",
            axisLabel: "Día de la semana",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 5
        },
            {
                mode: "time",
                timeformat: "%m/%d",
                tickSize: [3, "day"],
                color: "black",
                axisLabel: "Fechas",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
            }],
        yaxis: {
            color: "black",
            tickDecimals: 2,
            axisLabel: "Nº de compras",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 5
        },
        legend: {
            noColumns: 0,
            labelFormatter: function (label, series) {
                return "<font color=\"white\">" + label + "</font>";
            },
            backgroundColor: "#000",
            backgroundOpacity: 0.9,
            labelBoxBorderColor: "#000000",
            position: "nw"
        },
        grid: {
            hoverable: true,
            borderWidth: 3,
            mouseActiveRadius: 50,
            backgroundColor: { colors: ["#ffffff", "#EDF5FF"] },
            axisMargin: 20
        }
    };

    // === Make chart === //
    var plot = $.plot($(".chart"), dataset, options);




    function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
    }

    var previousPoint = null, previousLabel = null;
    var monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];



    $.fn.UseTooltip = function () {
        $(this).bind("plothover", function (event, pos, item) {
            if (item) {
                if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                    previousPoint = item.dataIndex;
                    previousLabel = item.series.label;
                    $("#tooltip").remove();

                    var x = item.datapoint[0];
                    var y = item.datapoint[1];
                    var date = new Date(x);
                    var color = item.series.color;

                    showTooltip(item.pageX, item.pageY, color,
                        "<strong>" + item.series.label + "</strong><br>"  +
                            (date.getMonth() + 1) + "/" + date.getDate() +
                            " : <strong>" + y + "</strong> compras");
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    };

    function showTooltip(x, y, color, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y - 40,
            left: x - 120,
            border: '2px solid ' + color,
            padding: '3px',
            color:'#000',
            'font-size': '9px',
            'border-radius': '5px',
            'background-color': '#fff',
            'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            opacity: 0.9
        }).appendTo("body").fadeIn(200);
    }





}

function loadClip(){
    // var clip;
    // var intervalId;
    // var textos=[
    // "Veo que estas escribiendo una carta. Necesitas ayuda?",
    // "Veo que necesitas ayuda.",
    // "Necesitas que te de una mano?",
    // "Estas seguro que no necesitas ayuda?",
    // "Yo soy tu amigo. Tu quieres ser mi amigo?",
    // "A veces yo aparezco por ninguna razon en particular. Como ahora.",
    // "Tu computador parece estar prendido.",
    // "Veo que estas tratando de trabajar. Necesitas que te moleste?",
    // "Veo que tu vida no tiene sentido. Necesitas consejo?",
    // "Parece que estas conectado a internet.",
    // "Veo que has estado usando el mouse.",
    // "Tu productividad ha ido decreciendo con el tiempo. Espero que estes bien.",
    // "He detectado un movimiento del mouse. Esto es normal.",
    // "Veo que tu postura no es la adecuada. Por favor sientate bien.",
    // "Tu monitor se encuentra 100% operacional.",
    // "Si necesitas ayuda, por favor pidemela.",
    // "Tu mouse esta sucio. Limpialo para un rendimiento optimo.",
    // "¿Quieres que me oculte? Esa funcionalidad no se ha implementado.",
    // "¿Quieres que me oculte?<br /><br /><button onclick='javascript:clip_hide()'>Si, por favor!</button><button>No, gracias</button>"
    // ];
    // clippy.load('Clippy', function(agent) {
    //     clip=agent;
    //     clip_start(false);
        
    // //var animaciones=agent.animations();
        
    // // Do anything with the loaded agent
        
    // });
    
    // function clip_start(vengativo){
    //     clip.show();
        
        
    //     if(!vengativo){
    //         intervalId=setInterval(function(){
    //             clip.animate();
    //             var randomTextId=Math.floor((Math.random()*textos.length));
    //             clip.speak(textos[randomTextId]);
    //         },10000);
    //     }else{
    //         clip.speak("Volviiiiii! Te echaba de menos.");
    //         setTimeout(function(){
    //             clip.speak("¡Por que me dejaste! ¿Guardaste tu proceso? jajajaj");
                
    //         },5000);
    //         setTimeout(function(){
    //             $(".box").hide();
    //             clip.speak("Upppps");
    //         },10000);
    //         setTimeout(function(){
    //             $(".box").show();
    //         },15000);
            
    //         setTimeout(function(){
                
    //             intervalId=setInterval(function(){
                
    //                 clip.animate();
    //                 var randomTextId=Math.floor((Math.random()*textos.length));
    //                 clip.speak(textos[randomTextId]);
    //             },5000);
    //         },15000);
            
    //     }
    // }
    
    // function clip_hide(){
    //     clip.stop();
    //     clip.hide();
    //     clearInterval(intervalId);
           
    //     setTimeout(function(){
    //         clip_start(true);
    //     },10000);
    // }
}