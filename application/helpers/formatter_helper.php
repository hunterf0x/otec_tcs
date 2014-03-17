<?php

function format($dato,$tipo){
    if($dato===NULL)
        return '';
    
    
    if($tipo=='int')
        $dato=  number_format ($dato,0,',','.');
    else if ($tipo=='bool')
        $dato=$dato?'Sí':'No';
    else if ($tipo=='date'){
        if(strtotime('9999-12-31')==strtotime($dato))
            $dato='Sin modificaciones';
        else if(strtotime('9999-12-30')==strtotime($dato))
            $dato='Sin modificaciones';
        else
            $dato=strftime('%d/%m/%Y',strtotime($dato));
    }
    else if ($tipo=='url'){
    	if((strtolower(trim($dato))!='sin modificaciones' && $dato!='') && (strtolower(trim($dato))!='no tiene' && $dato!='')){
        	$dato = '<a href="'.$dato.'" target="_blank">Ver enlace</a>';
        }
        /*
        if(strtolower(trim($dato))=='sin modificaciones'){ 
            $hola = '';
        } elseif (strtolower(trim($dato))=='no tiene'){
            $hola = '';
        } else if ($dato!=''){
            $dato = '<a href="'.$dato.'" target="_blank">Ver enlace</a>';
        }*/

    }
    return $dato;
}

function excel_to_mysql($cell){
    $value=$cell->getValue();
    if( PHPExcel_Shared_Date::isDateTime($cell)){
        
        if(is_numeric($cell->getValue())){
            $value=PHPExcel_Shared_Date::ExcelToPHPObject($cell->getValue())->format('Y-m-d');
        }
    }

    
    return $value;
}

//Dynamically add JS files to header page
if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');
 
        if(empty($file)){
            return;
        }
 
        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}

//Dynamically add CSS files to header page
if(!function_exists('add_css')){
    function add_css($file='')
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
 
        if(empty($file)){
            return;
        }
 
        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){   
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css',$header_css);
        }else{
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css',$header_css);
        }
    }
}
 
if(!function_exists('put_headers')){
    function put_headers()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        $header_js  = $ci->config->item('header_js');
 
        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().'assets/css/'.$item.'" type="text/css" />'."\n";
        }
 
        foreach($header_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url().'assets/js/'.$item.'"></script>'."\n";
        }
        
        return $str;
    }
}

	function format_phone($area,$fono){
		$area = (strlen($area)==1)?'0'.$area:$area;
	    //return '(+56) '.substr($fono,0,2).' '.substr($fono,2,strlen($fono)-2);
	    return '(+56) '.$area.' '.$fono;
    }

    function format_number($number,$tipo){

        $arreglo = explode('.',$number);
        if (count($arreglo)>1 && $arreglo[1]=='00'){
            $valor = substr($arreglo[0], 0, strlen($arreglo[0])%3);
            $z=0; $formateado='';
            for ($x = strlen($arreglo[0])%3; $x <= strlen($arreglo[0]); $x = $x+3){
                if ($x != 0 && $x < 3){ $formateado .= substr($arreglo[0], 0, $x).'.';
                }else { $formateado .= substr($arreglo[0], $z, 3).'.'; }
                $z=$x;
            }
            if ($formateado[0]=='.'){ $formateado = substr($formateado,1,strlen($formateado)-1); }
            if ($formateado[strlen($formateado)-1]=='.'){ $formateado = substr($formateado, 0,strlen($formateado)-1); }
        } else if (count($arreglo)>1 && $arreglo[1]!='00'){
            $valor = substr($arreglo[0], 0, strlen($arreglo[0])%3);
            $z=0;
            $formateado='';
            for ($x = strlen($arreglo[0])%3; $x <= strlen($arreglo[0]); $x = $x+3){
                if ($x != 0 && $x < 3){ $formateado .= substr($arreglo[0], 0, $x).'.'; }
                else { $formateado .= substr($arreglo[0], $z, 3).'.'; }
                $z=$x;
            }
            if ($formateado[0]=='.'){ $formateado = substr($formateado,1,strlen($formateado)-1); }
            if ($formateado[strlen($formateado)-1]=='.'){ $formateado = substr($formateado, 0,strlen($formateado)-1); }
            $formateado.= ','.$arreglo[1];
        } else $formateado = format($number,$tipo);

        return $formateado;
    }