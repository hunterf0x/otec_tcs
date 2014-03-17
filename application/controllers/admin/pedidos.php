<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedidos extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        UsuarioSesion::force_login();
        if(!UsuarioSesion::usuario()->isActive()){
            show_error("Su cuenta se encuentra suspendida",301,"Error");
        }
        if(!UsuarioSesion::usuario()->isAdmin()){
            show_error("No dispone de los permisos necesarios",301,"Error");
        }
    }

    public function index() {
        
        
        $data['title']='Pedidos';
        $data['content']='admin/pedidos/index';
        $data['pedidos'] = Doctrine::getTable('Pedido')->createQuery('p')->orderBy('id DESC')->execute();
        
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/','Pedidos'=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function lista($op) {

        $per_page=10;
        $pag = $this->uri->segment(5)?$this->uri->segment(5):1;
        $path = 'admin/pedidos/lista/'.$op;
        $offset =  ($pag-1) * $per_page;
        $data['offset'] = $offset;
        $data['content']='admin/pedidos/index';

        if($op==1){
            $data['title']='Pedidos exitosos';
            $data['pedidos'] = Doctrine::getTable('Pedido')->createQuery('p')->where('p.estado = 1')->orderBy('id DESC')->limit($per_page)->offset($offset)->execute();
            $total = Doctrine::getTable('Pedido')->createQuery('p')->where('p.estado = 1')->count();

        }else {
            $data['title']='Pedidos inconclusos';
            $data['pedidos'] = Doctrine::getTable('Pedido')->createQuery('p')->where('p.estado is NULL')->orderBy('id DESC')->limit($per_page)->offset($offset)->execute();
            $total = Doctrine::getTable('Pedido')->createQuery('p')->where('p.estado is NULL')->count();

        }
        $data['total'] = $total;
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/','Pedidos'=>'/admin/pedidos',$data['title']=>null),'admin');

        $this->pagination->initialize(array(
            'uri_segment'=>5,
            'base_url'=> base_url().$path,
            'total_rows'=>$total,
            'per_page'=>$per_page,
            'use_page_numbers'=>true
        ));


        $this->load->view('admin/template',$data);
    }
    
    public function detalle($usuario_id, $id){
        
        $data['title'] = 'Detalle del pedido';
        $data['content']='admin/pedidos/detalle';
        $data['detalle'] = Doctrine::getTable('DetallePedido')->createQuery('d')->where('d.pedido_id = ?',$id)->orderBy('id DESC')->execute();
        
        
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/','Pedidos'=>'/admin/pedidos',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
        
    }

    public function compras($id){
        $this->load->helper('date');


        if($id==1){
            $pedidos = Doctrine::getTable('Pedido')
                ->createQuery('p')
                ->select('DATE(updated_at) Date, COUNT(DISTINCT id)  total ')
                ->where('estado = 1')
                ->groupBy('Date')
                ->execute();
        }else{
            $pedidos = Doctrine::getTable('Pedido')
                ->createQuery('p')
                ->select('DATE(updated_at) Date, COUNT(DISTINCT id)  total ')
                ->where('estado is NULL')
                ->groupBy('Date')
                ->execute();
        }




        foreach($pedidos as $r){

            $respuesta[] = array(strtotime($r->Date)*1000,$r->total);
        }


        echo json_encode($respuesta);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */