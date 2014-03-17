<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
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
        add_js('home-admin.js');
        add_js('jquery.flot.min.js');
        add_js('jquery.flot.time.js');
        add_js('jquery.flot.resize.min.js');
        add_js('jquery.flot.axislabels.js');

        $data['title']='Dashboard';
        $data['content']='admin/portada/inicio';

        
        
        $data['breadcrumb'] = breadcrumb(array('<i class="icon-home"></i>Home'=>'/','Dashboard'=>null),'admin');
        $this->load->view('admin/template',$data);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */