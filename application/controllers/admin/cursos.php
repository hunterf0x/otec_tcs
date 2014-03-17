<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cursos extends CI_Controller {
    
    public $data = array();
    
    public function __construct() {
        parent::__construct();
        
        UsuarioSesion::force_login();
        
        $this->load->helper('text');

        UsuarioSesion::force_login();
        if(!UsuarioSesion::usuario()->isActive()){
            show_error("Su cuenta se encuentra suspendida",301,"Error");
        }
        if(!UsuarioSesion::usuario()->isAdmin()){
            show_error("No dispone de los permisos necesarios",301,"Error");
        }
        
    }

    public function index() {
        $data['title']='Cursos';
        $data['content']='admin/cursos/index';

        $per_page=10;
        $pag = $this->uri->segment(4)?$this->uri->segment(4):1;
        $path = 'admin/cursos/index';
        $offset =  ($pag-1) * $per_page;
        $data['offset'] = $offset;

        $data['total'] = Doctrine::getTable('Curso')->createQuery('c')->count();
        $data['cursos'] = Doctrine::getTable('Curso')->createQuery('c')->orderBy('id DESC')->limit($per_page)->offset($offset)->execute();

        $this->pagination->initialize(array(
            'uri_segment'=>4,
            'base_url'=> base_url().$path,
            'total_rows'=>$data['total'],
            'per_page'=>$per_page,
            'use_page_numbers'=>true
        ));

        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function curso($id = null){

        if($id){
            $data['curso'] = Doctrine::getTable('Curso')->find($id);
            $data['title']=$data['curso']->nombre;
        }else
            $data['title']='Nuevo Curso';
        $data['content']='admin/cursos/curso';
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function curso_form($id = null){
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('codigo_sence', 'Codigo SENCE', 'required|max_length[10]');
        $this->form_validation->set_rules('horas_curso', 'Horas del curso', 'required|max_length[3]');

        $respuesta=new stdClass();
        $msje = 'El curso fue creado exitosamente.';
        if($this->form_validation->run()==TRUE){
    
            if($id){
                $curso = Doctrine::getTable('Curso')->find($id);
                $msje = 'El curso fue editado exitosamente.';
            }else
                $curso = new Curso();

            $curso->nombre = $this->input->post('nombre');
            $curso->codigo_sence = $this->input->post('codigo_sence');
            $curso->horas_curso = $this->input->post('horas_curso');

            $curso->save();


            $redirect = site_url('admin/cursos/index');
    
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
