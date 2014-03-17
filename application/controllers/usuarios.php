<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class usuarios extends CI_Controller {
    
    public function login_form() {
    
        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required|callback_check_password|callback_check_activo');
    
        $respuesta=new stdClass();
        if ($this->form_validation->run() == TRUE) {
            UsuarioSesion::login($this->input->post('usuario'),$this->input->post('password'));
            $respuesta->validacion=TRUE;
    
            $respuesta->redirect=$this->input->post('redirect')?$this->input->post('redirect'):$this->input->server('HTTP_REFERER');
    
        }else{
            $respuesta->validacion=FALSE;
            $respuesta->errores=validation_errors();
        }
    
        echo json_encode($respuesta);
    
    }
    
    function check_password($password){
        $autorizacion=UsuarioSesion::validar_acceso($this->input->post('usuario'),$this->input->post('password'));
    
        if($autorizacion)
            return TRUE;
    
        $this->form_validation->set_message('check_password','Usuario y/o contraseña incorrecta.');
        return FALSE;
    
    }
    
    function check_activo(){
        $autorizacion=UsuarioSesion::validar_activo($this->input->post('usuario'));
    
        if($autorizacion)
            return TRUE;
    
        $this->form_validation->set_message('check_activo','La cuenta de usuario se encuentra suspendida, por favor contacte al Administrador.');
        return FALSE;
    
    }


    public function usuario($id){
        if($id == isset(UsuarioSesion::usuario()->id)){
            $data['usuario'] = UsuarioSesion::usuario();
            $data['title'] = 'Mis datos';
            $data['content']='usuarios/usuario';
            $data['sidebar']=Doctrine::getTable('Categoria')->getCategoriasPadresNull();
            $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null));
            $region_id = $data['usuario']->region_codigo;
            $data['regiones'] = FuncionesHelper::getRecordsJson('region');
            $data['comunas'] = FuncionesHelper::getRecordsJson('comuna', $region_id);

            $this->load->view('template',$data);
        }else{
            redirect(site_url('inicio#login'));

        }

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
        
    
    
    
        $respuesta=new stdClass();
        $msje = 'El usuario fue creado exitosamente.';

        if($this->form_validation->run()==TRUE){

            if($id){
                $usuario = Doctrine::getTable('Usuario')->find($id);
                $msje = 'El usuario fue editado exitosamente.';
                $redirect = ($this->input->post('redirect'))?site_url('usuarios/usuario/'.$id):site_url();
            }else
                $usuario = new Usuario();


    
    
            $usuario->usuario = $this->input->post('usuario');
            if(!$id){
                $usuario->setPasswordWithSalt($this->input->post('password'));
                $usuario->perfil_id = 3;
            }

            $usuario->nombre = $this->input->post('nombre');
            $usuario->apellido = $this->input->post('apellido');
            $usuario->sexo = $this->input->post('sexo');
            $usuario->region_codigo = $this->input->post('region_codigo');
            $usuario->region_nombre = $this->input->post('region_nombre');
            $usuario->comuna_codigo = $this->input->post('comuna_codigo');
            $usuario->comuna_nombre = $this->input->post('comuna_nombre');
            $usuario->direccion = $this->input->post('direccion');
            $usuario->fono = $this->input->post('fono');

            $avatar = get_gravatar($this->input->post('usuario'));


            $usuario->avatar = $avatar;

            $usuario->save();
    

            $this->session->set_flashdata('message', $msje);
            $respuesta->validacion=true;
            $respuesta->redirect=$this->input->server('HTTP_REFERER');
    
        }else{
            $respuesta->validacion=false;
            $respuesta->errores=validation_errors();
        }
    
        echo json_encode($respuesta);
    }
    
    public function perfil($id){
        if($id == isset(UsuarioSesion::usuario()->id)){
            $data['title'] = 'Perfil de comprador';
            $data['content']='usuarios/perfil';
            
            $per_page=20;

            $pag = $this->uri->segment(4)?$this->uri->segment(4):1;


            $path = 'usuarios/perfil/'.$id;

            $offset =  ($pag-1) * $per_page;

            $total = Doctrine::getTable('Pedido')->createQuery('p')->where('p.usuario_id = ?',UsuarioSesion::usuario()->id)->count();
            $data['pedidos'] = Doctrine::getTable('Pedido')->createQuery('p')->where('p.usuario_id = ?',UsuarioSesion::usuario()->id)->orderBy('id DESC')->limit($per_page)->offset($offset)->execute();
            
            
            $data['sidebar']=Doctrine::getTable('Categoria')->getCategoriasPadresNull();
            $data['productos_ultimos'] = Doctrine::getTable('Producto')->getUltimosProductos();
            $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/',$data['title']=>null));
            

            $this->pagination->initialize(array(
                    'uri_segment'=>4,
                    'base_url'=> base_url().$path,
                    'total_rows'=>$total,
                    'per_page'=>$per_page,
                    'use_page_numbers'=>true
            ));
            
            $this->load->view('template',$data);
        }else{
            redirect(site_url('inicio#login'));
            
        }
    }
    
    public function detalle($usuario_id, $id){
        if($usuario_id==UsuarioSesion::usuario()->id){
            $data['title'] = 'Detalle de la compra';
            $data['content']='usuarios/detalle';
            $per_page=20;
            $offset=$this->input->get('offset')?$this->input->get('offset'):1;
            
            $total = Doctrine::getTable('DetallePedido')->createQuery('d')->where('d.pedido_id = ?',$id)->count();
            $data['detalle'] = Doctrine::getTable('DetallePedido')->createQuery('d')->where('d.pedido_id = ?',$id)->orderBy('id DESC')->limit($per_page)->offset($offset)->execute();
            
            
            $data['sidebar']=Doctrine::getTable('Categoria')->getCategoriasPadresNull();
            $data['productos_ultimos'] = Doctrine::getTable('Producto')->getUltimosProductos();
            $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/','Perfil'=>'/usuarios/perfil/'.$usuario_id,$data['title']=>null));
            
            
            $this->pagination->initialize(array(
                    'base_url'=>current_url().'?',
                    'total_rows'=>$total,
                    'per_page'=>$per_page
            ));
            
            
            
            $this->load->view('template',$data);
        }else{
            show_404();
        }
    }
}

?>