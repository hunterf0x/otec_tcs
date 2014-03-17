<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Widgets extends CI_Controller {
    
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

    public function sidebar() {

        $data['title']='Widgets Sidebar';
        $data['content']='admin/widgets/sidebar';
        $data['widgets'] = Doctrine::getTable('Widget')->createQuery('w')->where('w.sidebar = 1')->limit(3)->execute();
        
        
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }

    public function widget($id){
        $data['title']='Widget'.$id;
        $data['content']='admin/widgets/widget';
        $data['clientes'] = Doctrine::getTable('Producto')->getProductosDisponibles();
        $data['widget'] = Doctrine::getTable('Widget')->find($id);

        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }

    public function widget_form($id){

        $widget = Doctrine::getTable('Widget')->find($id);
        $respuesta=new stdClass();

        if($widget->id){
            $widget->producto_id = $this->input->post('producto_id');
            $widget->habilitado = $this->input->post('habilitado');
            $widget->save();

            $this->session->set_flashdata('message', 'El widget ha sido habilitado exitosamente');
            $respuesta->validacion=TRUE;
            $respuesta->redirect = site_url('admin/widgets/sidebar');
        }else{
            $respuesta->validacion=FALSE;
            $this->session->set_flashdata('message_error', 'El widget no existe, intentalo nuevamente');
            redirect($this->input->server('HTTP_REFERER'));
        }


        echo json_encode($respuesta);
    }


    public function slideshow_home(){
        $data['title']='Slideshow Home';
        $data['content']='admin/widgets/slideshow';
        $data['widgets'] = Doctrine::getTable('Widget')->createQuery('w')->where('slideshow = 1')->execute();



        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }


    public function widget_slide($id = null){
        if($id){
            $data['title']='Editar widget '.$id;
            $data['content']='admin/widgets/widget_slide';
            $data['clientes'] = Doctrine::getTable('Producto')->getProductosDisponibles();
            $data['widget'] = Doctrine::getTable('Widget')->find($id);
        }else{
            $data['title']='Nuevo widget';
            $data['content']='admin/widgets/widget_slide';
            $data['clientes'] = Doctrine::getTable('Producto')->getProductosDisponibles();
        }


        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null),'admin');
        $this->load->view('admin/template',$data);
    }

    public function widget_slide_form($id = null){
        $this->form_validation->set_rules('producto_id', 'Producto', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required');
        $this->form_validation->set_rules('imagen', 'Imagen', 'required');


        $respuesta=new stdClass();
        if($this->form_validation->run()==TRUE){

            if($id){
                $widget = Doctrine::getTable('Widget')->find($id);
            }else{
                $widget = Doctrine::getTable('Widget')->findOneBy('producto_id',$this->input->post('producto_id'));




                if(!$widget){
                    $widget = new Widget();

                }
            }




            $widget->producto_id = $this->input->post('producto_id');
            $widget->habilitado = $this->input->post('habilitado');
            $widget->slideshow = true;
            $widget->descripcion = $this->input->post('descripcion');
            $widget->imagen = $this->input->post('imagen');
            $widget->save();

            $this->session->set_flashdata('message', 'El widget ha sido habilitado exitosamente');
            $respuesta->validacion=TRUE;
            $respuesta->redirect = site_url('admin/widgets/slideshow_home');


        }else{
            $respuesta->validacion=false;
            $respuesta->errores=validation_errors();
        }

        echo json_encode($respuesta);
    }

    public function eliminar_slide($id){
        $widget = Doctrine::getTable('Widget')->find($id);

        if($widget->id){
            $widget = Doctrine::getTable('Widget')->find($id);
            $widget->slideshow = null;
            $widget->save();
            $this->session->set_flashdata('message', 'El widget ha sido habilitado exitosamente');
            redirect($this->input->server('HTTP_REFERER'));
        }else{

            $this->session->set_flashdata('message_error', 'El widget no existe, intentalo nuevamente');
            redirect($this->input->server('HTTP_REFERER'));
        }

        echo json_encode($respuesta);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */