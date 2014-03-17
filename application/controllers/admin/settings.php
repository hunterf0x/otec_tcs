<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {
    
    public function __construct() {
        parent::__construct();


        UsuarioSesion::force_login();

        $this->configure_ckeditor();

        if(!UsuarioSesion::usuario()->isActive()){
            show_error("Su cuenta se encuentra suspendida",301,"Error");
        }
        if(!UsuarioSesion::usuario()->isAdmin()){
            show_error("No dispone de los permisos necesarios",301,"Error");
        }
    }

    public function index() {
        if(UsuarioSesion::usuario()->perfil_id != 1){
            show_error("No dispone de los permisos necesarios",301,"Error");
        }
        add_js('jquery.Rut.js');
        $data['ckeditor'] = $this->data['ckeditor'];
        $data['ckeditor_2'] = $this->data['ckeditor_2'];
        $data['ckeditor_3'] = $this->data['ckeditor_3'];

        $data['title']='Configuración';
        $data['content']='admin/settings/index';
        $data['c'] = Doctrine::getTable('Configuracion')->getRecordInstance();
        $data['otec'] = Doctrine::getTable('Otec')->createQuery('o')->fetchArray();
        //$data['categorias'] = Doctrine::getTable('Categoria')->findAll();
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }
    
    public function configuracion_form($form){
      
        $data = $this->input->post();
        
        $respuesta=new stdClass();
        $msje = 'La configuración fue cambiada exitosamente.';
        

        foreach ($data as $k=> $d){
            if(!$conf = Doctrine::getTable('Configuracion')->findOneBy('param', $k)){
                $conf = new Configuracion();
            }
            $conf->param = $k;
            $conf->valor = $this->input->post($k);
            $conf->save();
        }

        $redirect = site_url('admin/settings');


        $this->session->set_flashdata('message', $msje);
        $respuesta->validacion=true;
        $respuesta->redirect=$redirect;
        
        echo json_encode($respuesta);
    }

    public function configuracion_otec(){

        $this->form_validation->set_rules('rut', 'RUT', 'required|rut');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('giro', 'Giro', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required');




        $respuesta=new stdClass();
        $msje = 'Los datos de la OTEC han sido guardados';
        if($this->form_validation->run()==TRUE){

            $otec = Doctrine::getTable('Otec')->findOneBy('id',1);
            if(!count($otec))
                $otec = new Otec();

            $otec->rut = $this->input->post('rut');
            $otec->nombre = $this->input->post('nombre');
            $otec->giro = $this->input->post('giro');
            $otec->direccion = $this->input->post('direccion');
            $otec->telefono = $this->input->post('telefono');


            $otec->save();


            $redirect = site_url('admin/settings');

            $this->session->set_flashdata('message', $msje);
            $respuesta->validacion=true;
            $respuesta->redirect=$redirect;

        }else{
            $respuesta->validacion=false;
            $respuesta->errores=validation_errors();
        }

        echo json_encode($respuesta);
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
                    array('Source'),
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
        $this->data['ckeditor_2'] = array
        (
            //ID of the textarea that will be replaced
            'id'   =>   'content2',
            'path'    =>   'assets/js/ckeditor',

            //Optionnal values
            'config' => array(
                'width'   =>   "80%",    //Setting a custom width
                'height'  =>   '150px',    //Setting a custom height
                'toolbar'     =>   array(
                    array('Source'),
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
        $this->data['ckeditor_3'] = array
        (
            //ID of the textarea that will be replaced
            'id'   =>   'content3',
            'path'    =>   'assets/js/ckeditor',

            //Optionnal values
            'config' => array(
                'width'   =>   "80%",    //Setting a custom width
                'height'  =>   '150px',    //Setting a custom height
                'toolbar'     =>   array(
                    array('Source'),
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
    
    


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */