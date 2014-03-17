<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clases extends CI_Controller {
    
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
        $data['title']='Clases';
        $data['content']='admin/clases/index';

        $per_page=10;
        $pag = $this->uri->segment(4)?$this->uri->segment(4):1;
        $path = 'admin/clases/index';
        $offset =  ($pag-1) * $per_page;
        $data['offset'] = $offset;

        $data['total'] = Doctrine::getTable('Clase')->createQuery('c')->count();
        $data['clases'] = Doctrine::getTable('Clase')->createQuery('c')->orderBy('id DESC')->limit($per_page)->offset($offset)->execute();

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
    
    public function clase($id_curso = null, $id = null){

        if($id_curso){
            $data['curso'] = Doctrine::getTable('Curso')->find($id_curso);
        }

        if($id){
            $data['clase'] = Doctrine::getTable('Clase')->find($id);
            $data['title']=$data['clase']->nombre;
        }else
            $data['title']='Nueva Clase';
        $data['content']='admin/clases/clase';
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }

    public function check_horas($dias){
        $horas = $this->input->post('horas');
        foreach($dias as $k=>$d){
            //echo $d.' '.$horas[$k];
            if(!$horas[$k]){
                $this->form_validation->set_message('check_horas','Debe ingresar al menos una hora para una clase');
                return FALSE;
            }




        }
        return TRUE;
    }

    public function clase_form($id = null){


        $horas = $this->input->post('horas');



        $this->form_validation->set_rules('codigo_sence', 'Codigo SENCE', 'required|max_length[10]');
        $this->form_validation->set_rules('start', 'Fecha de inicio', 'required');
        $this->form_validation->set_rules('end', 'Fecha de término', 'required');
        $this->form_validation->set_rules('dias', 'Día de clase', 'required|callback_check_horas[]');
        $this->form_validation->set_rules('observaciones', 'Observaciones', 'required');

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
