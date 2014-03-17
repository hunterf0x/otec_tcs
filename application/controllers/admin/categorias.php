<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {
    
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
        $data['title']='Categorias';
        $data['content']='admin/categorias/index';
        $data['categorias'] = Doctrine::getTable('Categoria')->getCategoriasPadresNull();
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/','Categorías'=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function categoria($id = null){
        
        if($id){
            $data['categoria'] = Doctrine::getTable('Categoria')->find($id);
            $data['title']='Categoria '.$data['categoria']->nombre;
        }else 
            $data['title']='Nueva Categoria';
        $data['content']='admin/categorias/categoria';
        
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/','Categorías'=>'admin/categorias/index', $data['title'] => null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function categoria_form($id = null){
        $this->form_validation->set_rules('nombre', 'Nombre de la categoría', 'required|is_unique[categoria.nombre.id.'.$id.']');
        $this->form_validation->set_rules('descripcion', 'Descripción de la categoría', 'required');
        
        
        $respuesta=new stdClass();
        $msje = 'La categoría ha sido creada.';
        if($this->form_validation->run()==TRUE){
        
            if($id){
                $categoria = Doctrine::getTable('Categoria')->find($id);
                $msje = 'La categoría ha sido editada.';
            }else
                $categoria = new Categoria();
            
        
            $categoria->nombre = $this->input->post('nombre');
            $categoria->descripcion = $this->input->post('descripcion');
            $categoria->public = $this->input->post('public');
            $categoria->estado = $this->input->post('estado');
        
            $categoria->save();
            $redirect = site_url('admin/categorias/index');
        
            $this->session->set_flashdata('message', $msje);
            $respuesta->validacion=true;
            $respuesta->redirect=$redirect;
        
        }else{
            $respuesta->validacion=false;
            $respuesta->errores=validation_errors();
        }
        
        echo json_encode($respuesta);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */