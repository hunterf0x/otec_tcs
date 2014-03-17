<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientes extends CI_Controller {
    
    public $data = array();
    
    public function __construct() {
        parent::__construct();
        
        UsuarioSesion::force_login();
        
        $this->load->helper('text');
        $this->configure_ckeditor();
        
        
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
        $data['title']='Clientes';
        $data['content']='admin/clientes/index';


        $per_page=10;
        $pag = $this->uri->segment(4)?$this->uri->segment(4):1;
        $path = 'admin/clientes/index';
        $offset =  ($pag-1) * $per_page;
        $data['offset'] = $offset;


        $data['total'] = Doctrine::getTable('Cliente')->createQuery('c')->count();
        $data['clientes'] = Doctrine::getTable('Cliente')->createQuery('c')->orderBy('id DESC')->limit($per_page)->offset($offset)->execute();


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
    
    public function cliente($id = null){
        add_js('tagmanager.js');
        add_js('bootstrap-typeahead.js');
        add_css('tagmanager.css');
        add_js('jquery.Rut.js');
        if($id){
            $data['cliente'] = Doctrine::getTable('Cliente')->find($id);
            $data['title']=$data['cliente']->nombre;
        }else
            $data['title']='Nuevo Cliente';
        $data['content']='admin/clientes/cliente';
        
        
        

        
        $data['ckeditor'] = $this->data['ckeditor'];
        
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function cliente_form($id = null){
        $this->form_validation->set_rules('rut', 'RUT', 'required|is_unique[cliente.rut.id.'.$id.']|rut');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('giro', 'Giro del cliente', 'required');
        $this->form_validation->set_rules('contacto_empresa', 'Contacto de empresa', 'required');
        $this->form_validation->set_rules('contacto_email', 'Email de contacto', 'required|valid_email');
        $this->form_validation->set_rules('contacto_telefono', 'Teléfono de contacto', 'required');

        
    

        $respuesta=new stdClass();
        $msje = 'El cliente fue creado exitosamente.';
        if($this->form_validation->run()==TRUE){
    
            if($id){
                $cliente = Doctrine::getTable('Cliente')->find($id);
                $msje = 'El cliente fue editado exitosamente.';
            }else
                $cliente = new Cliente();

            $cliente->rut = $this->input->post('rut');
            $cliente->nombre = $this->input->post('nombre');
            $cliente->giro = $this->input->post('giro');
            $cliente->contacto_empresa = $this->input->post('contacto_empresa');
            $cliente->contacto_email = $this->input->post('contacto_email');
            $cliente->contacto_telefono = $this->input->post('contacto_telefono');


            $cliente->save();


            $redirect = site_url('admin/clientes/index');
    
            $this->session->set_flashdata('message', $msje);
            $respuesta->validacion=true;
            $respuesta->redirect=$redirect;
    
        }else{
            $respuesta->validacion=false;
            $respuesta->errores=validation_errors();
        }
    
        echo json_encode($respuesta);
    }
    
    public function publicar($id){
        if(!$id)
            show_404();
        
        $producto = Doctrine::getTable('Producto')->find($id);
        if($producto->public){
            $producto->public = false;
            $opcion = 'despublicado';
        }else{
            $producto->public = true;
            $opcion = 'publicado';
        } 
            
        
        $msje = 'El producto '.$producto->id.' fue '.$opcion.' exitosamente.';
        $producto->save();
        $this->session->set_flashdata('message', $msje);
        
        redirect($this->input->server('HTTP_REFERER'), 'location');
        
        
        
    }
    
    private function configure_ckeditor()
    {
        //helpers for CKEditor
        
        $this->load->helper('ckeditor');
    
        //Ckeditor's configuration
        $this->data['ckeditor'] = array
        (
                //ID of the textarea that will be replaced
                'id'   =>   'content',
                'path'    =>   'assets/js/ckeditor',
    
                //Optionnal values
                'config' => array(
                        'width'   =>   "80%",    //Setting a custom width
                        'height'  =>   '150px',    //Setting a custom height
                        'toolbar'     =>   array(
                                array('Bold', 'Italic','Underline','Strike'),
                                array('Format','FontSize'),
                                array('NumberedList','BulletedList'),
                                array('Link','Unlink','Anchor'),
                                
                                array('Smiley'),
                                '/'
                        )
                ),
    
                //definición del estilo del ckeditor
        );
    }

    public function tags($id=null){
        if($id){
            $producto = Doctrine::getTable('Producto')->findOneBy('id',$id);
            foreach($producto->Tags as $t){
                $respuesta[] = $t->etiqueta;
            }
        }else{
            $tags = Doctrine::getTable('Tag')->findAll();
            foreach($tags as $t){
                $respuesta[] = $t->etiqueta;
            }
        }




        echo json_encode($respuesta);
    }
}
