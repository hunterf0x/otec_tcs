<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autenticacion extends CI_Controller {
    public function  __construct() {
        parent::__construct();
    }
    
    public function login(){
        $data['redirect']=$this->session->flashdata('redirect');
        
        $this->load->view('admin/autenticacion/login', $data);
    }

    public function login_form() {

        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required|callback_check_password|callback_check_activo');
        
        $respuesta=new stdClass();
        if ($this->form_validation->run() == TRUE) {
            UsuarioSesion::login($this->input->post('usuario'),$this->input->post('password'));
            $respuesta->validacion=TRUE;
            
            
            $respuesta->redirect=$this->input->post('redirect')?$this->input->post('redirect'):$this->input->server('HTTP_REFERER');
            
            if(!UsuarioSesion::usuario()->isAdmin())
                $respuesta->redirect = site_url('inicio');
            
        }else{
            $respuesta->validacion=FALSE;
            $respuesta->errores=validation_errors();
        }
        
        echo json_encode($respuesta);

    }


    function logout() {
        UsuarioSesion::logout();
        redirect($this->input->server('HTTP_REFERER'));
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
    
    public function lostpassword() {
        $this->load->helper('captcha');
        $vals = array(
                'img_path'	 => FCPATH.'assets/captcha/',
                'img_url'	 => site_url('assets/captcha').'/',
                'font_path'	 => FCPATH.'assets/frontend/font/museo_slab_500-webfont.ttf',
                'img_width'	 => '150',
                'img_height' => 40,
                'expiration' => 600
        );
    
        $cap = create_captcha($vals);
        $captcha = new Captcha();
        $captcha->captcha_time = $cap['time'];
        $captcha->ip_address = $this->input->ip_address();
        $captcha->word = $cap['word'];
        $captcha->save();
         
        $data['captcha'] = $cap;
    
        $data['title']='Recuperar contraseña';
        $this->load->view('admin/autenticacion/lostpassword', $data);
    }
    
    public function lostpassword_form() {
        
        $this->form_validation->set_rules('usuario', 'correo electrónico', 'required|valid_user');
        $this->form_validation->set_rules('captcha', 'código', 'required|check_captcha['.$this->input->ip_address().']');
    
        $respuesta=new stdClass();
        if ($this->form_validation->run() == TRUE) {
    
            $respuesta->validacion=TRUE;
            $respuesta->redirect=site_url('admin/autenticacion/login');
            $u = Doctrine::getTable('Usuario')->findBy('usuario', $this->input->post('usuario'))->getFirst();
    
            if($this->sendConfirmacion($u)){
    
                $this->session->set_flashdata('message', 'Se ha enviado un email a su casilla para completar el proceso de cambiar su contraseña.');
            }
    
    
        }else{
            $respuesta->validacion=FALSE;
            $respuesta->errores=validation_errors();
        }
    
        echo json_encode($respuesta);
    
    }
    
    public function sendConfirmacion(Usuario $u){
         
    
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'hector.varas.serrano@gmail.com';
        $config['smtp_pass'] = 'laclavetemporal';
        $config['smtp_port'] = 465;
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
    
    
        $hash = md5(rand(0,1000));
        $time_valido = strtotime("now");
        $url_segment = 'u='.$u->usuario.'&h='.$hash;
         
        $html = 'haz click en el siguiente enlace para resetear tu contraseña <br>
                <a href="'.site_url('admin/autenticacion/resetear_password').'/?'.$url_segment.'">Link</a>
                ';
    
        $u->hash_newpassword = $hash;
        $u->hash_time = $time_valido;
    
    
        $u->save();
    
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //@todo_: cambiar por una casilla cuando este creada
        $this->email->from('hector.varas.serrano@gmail.com', 'Hunter SHOP');
        
        $this->email->to($u->usuario);
    
        $this->email->subject('Cambio contraseña');
        $this->email->message($html);
    
        $this->email->send();
    
        //echo $this->email->print_debugger();
    
        return true;
    
    }
    
    public function resetear_password(){
        $u = $this->input->get('u');
        $h = $this->input->get('h');
        $expiration = time()-3600;
    
        $usuario = Doctrine_Query::create()
        ->from('Usuario u')
        ->where('u.usuario = ? AND u.hash_newpassword = ? AND u.hash_time > ?',array($u,$h,$expiration))
        ->fetchOne();
    
        if($usuario){
            $data['usuario'] = $usuario;
            $data['title']='Resetear contraseña';
            $this->load->view('admin/autenticacion/resetear_password', $data);
        }else{
            $this->session->set_flashdata('message_error', 'El tiempo para cambiar tu contraseña ha expirado, intentalo de nuevo');
            redirect(site_url('admin/autenticacion/lostpassword'));
        }
    
        $data['title']='Resetear contraseña';
        $this->load->view('admin/autenticacion/resetear_password', $data);
    }
    
    public function resetear_password_form(){
    
        $this->form_validation->set_rules('password', 'Contraseña', 'required|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Confirmación contraseña', 'required');
    
        $respuesta=new stdClass();
        if(!$this->input->post('usuario')){
            $respuesta->validacion=TRUE;
            $this->session->set_flashdata('message_error', 'ha ocurrido un problema, por favor intentelo de nuevo');
            $respuesta->redirect=site_url('admin/autenticacion/lostpassword');
        }else{
            if ($this->form_validation->run() == TRUE) {
    
                $respuesta->validacion=TRUE;
                $respuesta->redirect=site_url('admin/autenticacion/login');
                $u = Doctrine::getTable('Usuario')->findBy('usuario', $this->input->post('usuario'))->getFirst();
    
                if($this->changePassword($u)){
    
                    $this->session->set_flashdata('message', 'Su contraseña ha sido cambiada exitosamente');
                }
    
    
            }else{
                $respuesta->validacion=FALSE;
                $respuesta->errores=validation_errors();
            }
        }
    
    
    
        echo json_encode($respuesta);
    }
    
    
    public function changePassword(Usuario $u){
        $u->setPasswordWithSalt($this->input->post('password'));
        $u->hash_newpassword = NULL;
        $u->hash_time = NULL;
        $u->save();
        return true;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
