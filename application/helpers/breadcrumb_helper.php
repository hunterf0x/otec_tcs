<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Generador de codigo HTML para breadcrumbs
 * Recibe un arreglo de la forma:
 * array(
 *      $nombre1 => $url1,
 *      $nombre2 => $url2
 * )
 */
function breadcrumb($data,$escena=null){
   
    
    
    switch ($escena){
        case 'admin':
            $i=0;
            $breadcrumb='<div id="breadcrumb">';
            foreach ($data as $nombre=>$url){
                if($url)
                    $breadcrumb.='<a href="'.site_url($url).'" >'.$nombre.'</a>'.($i==count($data)-1?'':'<span class="divider">></span>').'</li>';
                else
                    $breadcrumb.='<a class="current">'.$nombre.($i==count($data)-1?'':'<span class="divider">></span>').'</a>';
            
                $i++;
            }
            $breadcrumb.='</div>';
            break;
        
        default:
            $i=0;
            $breadcrumb='<ul class="breadcrumb">';
            foreach ($data as $nombre=>$url){
                if($url)
                    $breadcrumb.='<li><a href="'.site_url($url).'">'.$nombre.'</a>'.($i==count($data)-1?'':'<span class="divider">/</span>').'</li>';
                else
                    $breadcrumb.='<li class="active">'.$nombre.($i==count($data)-1?'':'<span class="divider">></span>').'</li>';
            
                $i++;
            }
            $breadcrumb.='</ul>';
            break;
    }
    
    
    
    
    return $breadcrumb;
}