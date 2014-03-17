<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'application/third_party/qqFileUploader.php';

class Uploader extends CI_Controller {

    public function __construct() {
        parent::__construct();

        UsuarioSesion::force_login();
    }

    public function producto(){
	    $uploader = new qqFileUploader();

// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $uploader->allowedExtensions = array('jpg','jpeg','png');

// Specify max file size in bytes.
        $uploader->sizeLimit = 2 * 1024 * 1024;

// Specify the input name set in the javascript.
        $uploader->inputName = 'qqfile';

// If you want to use resume feature for uploader, specify the folder to save parts.
        //$uploader->chunksFolder = 'chunks';

// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
        $result = $uploader->handleUpload('uploads/clientes');

// To save the upload with a specified name, set the second parameter.
// $result = $uploader->handleUpload('uploads/', md5(mt_rand()).'_'.$uploader->getName());
// To return a name used for uploaded file you can use the following line.
        $result['uploadName'] = $uploader->getUploadName();

        $uploader->createThumbs('uploads/clientes/','uploads/clientes/thumbs/',160);
        
        
        header("Content-Type: text/plain");
        echo json_encode($result);
    }


    public function slide(){
        $uploader = new qqFileUploader();

// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $uploader->allowedExtensions = array('jpg','jpeg','png');

// Specify max file size in bytes.
        $uploader->sizeLimit = 2 * 1024 * 1024;

// Specify the input name set in the javascript.
        $uploader->inputName = 'qqfile';

// If you want to use resume feature for uploader, specify the folder to save parts.
        //$uploader->chunksFolder = 'chunks';

// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
        $result = $uploader->handleUpload('uploads/slides');

// To save the upload with a specified name, set the second parameter.
// $result = $uploader->handleUpload('uploads/', md5(mt_rand()).'_'.$uploader->getName());
// To return a name used for uploaded file you can use the following line.
        $result['uploadName'] = $uploader->getUploadName();

        $uploader->createThumbs('uploads/slides/','uploads/slides/thumbs/',160);


        header("Content-Type: text/plain");
        echo json_encode($result);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */