<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class FuncionesHelper
 */
class FuncionesHelper {

    public function __construct() {
    }
    
    /**
     * function getRecords
     * @param string $search
     * @param int $id_item
     * @param string params
     * @return mixed
     */
    public static function getRecords($search = null, $id_item = null, $params = null){
        
        if(!isset($params)){
            if(isset($id_item))
                $elemento = Doctrine::getTable($search)->findById($id_item);
            else
                $elemento = Doctrine::getTable($search)->findAll();
        }else{
            switch ($params[0]){
                case 'only':
                    $elemento = Doctrine::getTable($search)->{$params[1]}();
                    break;
                case 'dql':
                    $elemento = Doctrine::getTable($search)->createQuery('q')->where('q.'.$params[1].' = ?', $params[2]);
                    break;
                default:
            }
        }
        return $elemento;
    }

    /**
     * @param null $search
     * @param null $params
     * @return mixed
     */
    public static function getRecordsJson($search = null, $params = null){
        switch ($search){
            case 'region':
                $url = 'http://apis.modernizacion.cl/dpa/regiones';
                $result = self::getCurl($url);
                break;
            case 'comuna':
                if($params)
                    $url_segment = '/regiones/'.$params;
                else 
                    $url_segment = '';
                
                $url = 'http://apis.modernizacion.cl/dpa'.$url_segment.'/comunas';
                $result = self::getCurl($url);
                
                break;
            default:
                break;
        }
        
        return $result;
    }

    /**
     * @param $json_url
     * @return mixed
     */
    private static function getCurl($json_url){
    
        // Initializing curl
        $ch = curl_init( $json_url );
        	
        // Configuring curl options
        $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
        );
    
        // Setting curl options
        curl_setopt_array( $ch, $options );
    
        // Getting results
        $result =  curl_exec($ch); // Getting JSON result string
    
        $data = json_decode($result);
        return $data;
    }

    /**
     * @param $controlador
     * @return bool
     */
    public static function is_home($controlador){
        $CI = & get_instance();
        return $CI->router->fetch_class() === $controlador ? true : false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public  static function getImageCarrito($id){
        $query =  Doctrine_Query::create()
                    ->select('p.imagen')
                    ->from('Producto p')
                    ->where('p.id = ?', $id)
                    ->fetchOne();
        
        
        
        return $query->imagen;
        
    }
    
    
}

?>