$(document).ready(function(){
    loadClip();

    loadChart();
    $("#chart").UseTooltip();









    
    
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