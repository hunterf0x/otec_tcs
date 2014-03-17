<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategorias extends CI_Controller {
    
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
        $data['title']='Sub categoria';
        $data['content']='admin/subcategorias/index';
        $data['categorias'] = Doctrine::getTable('Categoria')->findAll();
        $this->load->view('admin/template',$data);
    }
    
    public function ver($categoria_id = null){
        $categoria = Doctrine::getTable('Categoria')->find($categoria_id);
        $data['categoria'] = $categoria;
        $data['subcategorias'] = $categoria->SubCategorias;
        $data['title']='Subcategorías de '.$categoria->nombre;
    
        $data['content']='admin/subcategorias/index';
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$categoria->nombre=>null),'admin');
    
        $this->load->view('admin/template',$data);
    }
    
    public function subcategoria($categoria_parent = null,$subcategoria_id = null){
        if($subcategoria_id){
            $data['categoria'] = Doctrine::getTable('Categoria')->find($subcategoria_id);
            $data['title']='Sub categoria '.$data['categoria']->nombre;
        }else
            $data['title']='Nueva Sub categoria';
        
        $categoria_padre = Doctrine::getTable('Categoria')->find($categoria_parent);
        
        if(!$categoria_padre->parent_id)
            $data['subcategorias'] = Doctrine::getTable('Categoria')->getCategoriasPadresNull();
        else 
            $data['subcategorias'] = $categoria_padre->getSubcategoriasHijas();
        
        
        $data['parent_id'] = ($categoria_parent)?$categoria_parent:'';
        
        $data['content']='admin/subcategorias/subcategoria';
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        
        $this->load->view('admin/template',$data);
    }
    
    public function subcategoria_form($id = null){
        $this->form_validation->set_rules('parent_id', 'Categoría padre', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre de la subcategoría', 'required|is_unique[categoria.nombre.id.'.$id.']');
        $this->form_validation->set_rules('descripcion', 'Descripción de la subcategoría', 'required');
    
    
        $respuesta=new stdClass();
        $msje = 'La subcategoría ha sido creada.';
        if($this->form_validation->run()==TRUE){
    
            if($id){
                $categoria = Doctrine::getTable('Categoria')->find($id);
                $msje = 'La subcategoría ha sido editada.';
            }else
                $categoria = new Categoria();
    
            $categoria->parent_id = $this->input->post('parent_id');
            $categoria->nombre = $this->input->post('nombre');
            $categoria->descripcion = $this->input->post('descripcion');
            $categoria->public = $this->input->post('public');
            $categoria->estado = $this->input->post('estado');
    
            $categoria->save();
            $redirect = site_url('admin/subcategorias/ver/'.$categoria->parent_id);
    
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