$(document).ready(function(){

    
    $(document).on("submit",".ajaxForm",function(){
        var form=this;
        if(!form.submitting){
            form.submitting=true;
            var boton = $(this).find('button[type="submit"]');
            boton.attr("disabled", "disabled");
            if(boton.attr('data-loading-text'))
                boton.button('loading');
            $.ajax({
                url: form.action,
                data: $(form).serialize(),
                type: form.method,
                dataType: "json",
                success: function(response){
                	if(response.validacion){
                        if(response.redirect){
                            window.location=response.redirect;
                        }else{
                            var f=window[$(form).data("onsuccess")];
                            f(form);
                        }
                    }
                    else{
                        $(form).find(".validacion").html(response.errores);
                        $('html, body').animate({
                            scrollTop: $(form).find(".validacion").offset().top-10
                        });
                    }
                },
                complete: function(){
                   boton.removeAttr("disabled").button('reset'); 
                   form.submitting=false;
                }
            });
        }
        return false;
    });
    
    $(document).on("submit",".ajaxForm-registro",function(){
        var form=this;
        if(!form.submitting){
            form.submitting=true;
            
            $.ajax({
                url: form.action,
                data: $(form).serialize(),
                type: form.method,
                dataType: "json",
                success: function(response){
                	if(response.validacion){
                        if(response.redirect){
                            window.location=response.redirect;
                        }else{
                            var f=window[$(form).data("onsuccess")];
                            f(form);
                        }
                    }
                    else{
                        $(form).find(".validacion_registro").html(response.errores);
                        $('.body-registro').animate({
                    		scrollTop: 0
                    		} , 600
                        );
                    }
                },
                complete: function(){
                   
                   form.submitting=false;
                }
            });
        }
        return false;
    });
    
    
    $('a.tree-toggler').click(function () {
    	$(this).parent().children('ul.tree').toggle(300);
	});
    
    
    
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
      
      $('.addtocart').on('click', function() {
    	  var dataString = $(this).data('producto'); //JSON-formatted string
    	  
          $.ajax({  
              type: 'POST',  
              url: site_url + 'carrito/addCart/'+ dataString,  
              data: dataString,
              dataType: "json",
              success: function(response){
            	  if(response.validacion){
            		  
            		  $('#myCart #cantidad').html(response.cantidad);
            		  $('#myCart .total-carro').html('$'+response.total);
            		  $('.product-add').show(200).html('1 x ' + response.producto.nombre).delay(2000).fadeOut(1000);
                  }else{
                	  $('.product-add').show(200).html('Error');
                  }
              }
          });
      });

      if ( jQuery.isFunction($.fn.TouchSpin) ) {
          $("input[name='cantidad']").TouchSpin({
        	  min: 1
          });
          $("input[name='qty[]']").TouchSpin({
        	  min: 1
          });
      };



      $(document).on("submit",".ajaxForm-comprar",function(){
          
    	  var form=this;
          if(!form.submitting){
              form.submitting=true;
              var boton = $(this).find('button[type="submit"]');
              boton.attr("disabled", "disabled");
              if(boton.attr('data-loading-text'))
                  boton.button('loading');
              $.ajax({
                  url: form.action,
                  data: $(form).serialize(),
                  type: form.method,
                  dataType: "json",
                  success: function(response){
                  	if(response.validacion){
                          if(response.redirect){
                              window.location=response.redirect;
                          }
                      }
                      else{
                          $(form).find(".validacion").html(response.errores);
                          $('html, body').animate({
                              scrollTop: $(form).find(".validacion").offset().top-10
                          });
                      }
                  },
                  complete: function(){
                     boton.removeAttr("disabled").button('reset'); 
                     form.submitting=false;
                  }
              });
          }
          return false;
      });

    if(location.hash=='#login'){
        $('#login').modal({
            keyboard: false
        })
    }

    $('.addtip').tooltip();


      
});