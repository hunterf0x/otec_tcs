<?php
class UsuarioSesion {

    private static $user;

    private function __construct() {
        
    }

    public static function usuario() {

        if (!isset(self::$user)) {

            $CI = & get_instance();

            if (!$user_id = $CI->session->userdata('usuario_id')) {
                return FALSE;
            }

            if (!$u = Doctrine::getTable('Usuario')->find($user_id)) {
                return FALSE;
            }

            self::$user = $u;
        }

        return self::$user;
    }
    
    public static function force_login(){
        $CI = & get_instance();
        
        if(!self::usuario()){
            $CI->session->set_flashdata('redirect',current_url());
            redirect('/admin/autenticacion/login');
        }
            
    }

    public static function login($usuario, $password) {
        $CI = & get_instance();

        $autorizacion = self::validar_acceso($usuario, $password);

        if ($autorizacion) {
            $u = Doctrine::getTable('Usuario')->findOneByUsuario($usuario);

            $CI->session->set_userdata('usuario_id', $u->id);
            self::$user = $u;
			
           
            return TRUE;
        }

        return FALSE;
    }

    public static function validar_acceso($usuario, $password) {
        $u = Doctrine::getTable('Usuario')->findOneByUsuario($usuario);
        if ($u) {

            // this mutates (encrypts) the input password
            $u_input = new Usuario();
            $u_input->setPasswordWithSalt($password,$u->salt);

            // password match (comparing encrypted passwords)
            if ($u->password == $u_input->password) {
                unset($u_input);


                return TRUE;
            }

            unset($u_input);
        }

        // login failed
        return FALSE;
    }
    
    public static function validar_activo($usuario){
        $u = Doctrine::getTable('Usuario')->findOneByUsuario($usuario);
        if ($u) {
            if($u->activo)
                return TRUE;
        }
    
        return FALSE;
    }

    public static function logout() {
        $CI = & get_instance();
        self::$user = NULL;
        $CI->session->unset_userdata('usuario_id');
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

}

?>