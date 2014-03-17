<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tags extends CI_Controller {
    

    
    public function __construct() {
        parent::__construct();
        
        UsuarioSesion::force_login();
        
        $this->output->enable_profiler(FALSE);
        UsuarioSesion::force_login();
        if(!UsuarioSesion::usuario()->isActive()){
            show_error("Su cuenta se encuentra suspendida",301,"Error");
        }
        if(!UsuarioSesion::usuario()->isAdmin()){
            show_error("No dispone de los permisos necesarios",301,"Error");
        }
        
    }

    public function index() {
        $data['title']='Tags';
        $data['content']='admin/tags/index';
        $data['tags'] = Doctrine::getTable('Tag')->findAll();
        $data['categorias'] = Doctrine::getTable('Tag')->getEnumValues('categoria');
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function tag($id){
        if($id){
            $data['tag'] = Doctrine::getTable('Tag')->find($id);
            $data['title']='Editar '.$data['tag']->etiqueta;
            $data['categorias'] = Doctrine::getTable('Tag')->getEnumValues('categoria');
        }else{
            show_404();
            exit;
        }
        $data['content']='admin/tags/tag';
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }

    public function tag_form($id){
        $this->form_validation->set_rules('etiqueta', 'Etiqueta', 'required|is_unique[tag.etiqueta.id.'.$id.']');
        $respuesta=new stdClass();



        if($this->form_validation->run()==TRUE){

            $tag = Doctrine::getTable('Tag')->find($id);
            $msje = 'El tag fue editado exitosamente.';

            $tag->etiqueta = $this->input->post('etiqueta');
            $tag->categoria = $this->input->post('categoria_id');
            $tag->save();

            $redirect = site_url('admin/tags/index');

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
