<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    
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
        $data['title']='Usuarios';
        $data['content']='admin/usuarios/index';


        $per_page=15;
        $pag = $this->uri->segment(4)?$this->uri->segment(4):1;
        $path = 'admin/usuarios/index/';
        $offset =  ($pag-1) * $per_page;
        $data['offset'] = $offset;

        $data['total'] = Doctrine::getTable('Usuario')->createQuery('u')->count();
        $data['usuarios'] = Doctrine::getTable('Usuario')->createQuery('u')->orderBy('id ASC')->limit($per_page)->offset($offset)->execute();

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
    
    public function usuario($id = null){
        
        $region_id = null;
        if($id){
            $data['title']='Editar Usuario';
            $data['usuario'] = Doctrine::getTable('Usuario')->find($id);
            $region_id = $data['usuario']->region_codigo;
            
        }else
            $data['title']='Nuevo Usuario';
        $data['content']='admin/usuarios/usuario';
        
        
        $data['regiones'] = FuncionesHelper::getRecordsJson('region');
        $data['comunas'] = FuncionesHelper::getRecordsJson('comuna', $region_id);
        
        $data['perfiles'] = Doctrine::getTable('Perfil')->findAll();
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function usuario_form($id = null){
        
        if(!$id){
            $this->form_validation->set_rules('usuario', 'Email', 'required|valid_email|is_unique[usuario.usuario.id.'.$id.']');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Confirmación Password', 'required');
        }else 
            $this->form_validation->set_rules('usuario', 'Email', 'required|valid_email|is_unique[usuario.usuario.id.'.$id.']');
        
        $this->form_validation->set_rules('nombre', 'Nombre del usuario', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido del usuario', 'required');
        $this->form_validation->set_rules('sexo', 'Sexo del usuario', 'required');
        $this->form_validation->set_rules('region_codigo', 'Región del usuario', 'required');
        $this->form_validation->set_rules('comuna_codigo', 'Comuna del usuario', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección del usuario', 'required');
        $this->form_validation->set_rules('fono', 'Teléfono del usuario', 'required');
        $this->form_validation->set_rules('perfil_id', 'Perfil del usuario', 'required');
        
    
    
        $respuesta=new stdClass();
        $msje = 'El usuario fue creado exitosamente.';
        if($this->form_validation->run()==TRUE){
    
            if($id){
                $usuario = Doctrine::getTable('Usuario')->find($id);
                $msje = 'El usuario fue editado exitosamente.';
            }else
                $usuario = new Usuario();
    
            
            $usuario->usuario = $this->input->post('usuario');
            if(!$id)
                $usuario->setPasswordWithSalt($this->input->post('password'));
            $usuario->nombre = $this->input->post('nombre');
            $usuario->apellido = $this->input->post('apellido');
            $usuario->sexo = $this->input->post('sexo');
            $usuario->region_codigo = $this->input->post('region_codigo');
            $usuario->region_nombre = $this->input->post('region_nombre');
            $usuario->comuna_codigo = $this->input->post('comuna_codigo');
            $usuario->comuna_nombre = $this->input->post('comuna_nombre');
            $usuario->direccion = $this->input->post('direccion');
            $usuario->fono = $this->input->post('fono');
            $usuario->perfil_id = $this->input->post('perfil_id');

            $usuario->avatar = get_gravatar($this->input->post('usuario'));
            
            $usuario->save();
            
            $redirect = site_url('admin/usuarios/index');
    
            $this->session->set_flashdata('message', $msje);
            $respuesta->validacion=true;
            $respuesta->redirect=$redirect;
    
        }else{
            $respuesta->validacion=false;
            $respuesta->errores=validation_errors();
        }
    
        echo json_encode($respuesta);
    }
    
    public function toggleActive($id){
        $usuario = Doctrine::getTable('Usuario')->find($id);
        if($usuario->activo){
            $usuario->activo = false;
            $opcion = 'bloqueado';
        }else{
            $usuario->activo = true;
            $opcion = 'activado';
        } 
            
        $usuario->save();
        
        $msje = 'El usuario '.$usuario->usuario.' fue '.$opcion.' exitosamente.';
        $this->session->set_flashdata('message', $msje);
        
        redirect($this->input->server('HTTP_REFERER'), 'location');
    }
}
