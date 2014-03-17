<?php

Class MY_Form_validation extends CI_Form_validation {

    public function __construct($rules = array()) {
        parent::__construct($rules);

        $this->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>', '</div>');
    }
    
    public function is_unique($str, $field)
    {
        if (substr_count($field, '.')==3)
        {
            list($table,$field,$id_field,$id_val) = explode('.', $field);
            $query = $this->CI->db->limit(1)->where($field,$str)->where($id_field.' != ',$id_val)->get($table);
        } else {
            list($table, $field)=explode('.', $field);
            $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
        }
    
        return $query->num_rows() === 0;
    }

    public function rut($rut_con_dv) {
        $rut_con_dv = explode('-', $rut_con_dv);
        if (count($rut_con_dv) == 2) {
            $rut = str_replace('.', '', $rut_con_dv[0]);
            $dv = str_replace('k', 'K', $rut_con_dv[1]);
            /* Con las lineas anteriores le asignanos a las variables $rut y $dv, lo ingresado por formulario en la página anterior, solo utilizaremos el rut. El digito verificador, lo usaremos al final */
            $rutin = strrev($rut);
            /* Invertimos el rut con la funcion “strrev” */
            $cant = strlen($rutin);
            /* Contamos la cantidad de numeros que tiene el rut */
            $c = 0;
            /* Creamos un contador con valor inicial cero */
            while ($c < $cant) {
                $r[$c] = substr($rutin, $c, 1);
                $c++;
            }
            /* Hacemos un ciclo en el que se creara un array o arreglo que se llamara $r, en el cual se le asignara a cada valor del array, el valor correspodiente del rut, Por ej: para el rut 12346578, que invertido sería 87654321, el valor de $r[0] es 8, de $r[5] es 3 y asi sucesiva y respectivamente. */
            $ca = count($r);
            /* Contamos la cantidad de valores que tiene el arreglo con la función “count” */
            $m = 2;
            $c2 = 0;
            $suma = 0;
            /* En las lineas anteriores creamos 3 cosas, un multiplicador con el nombre $m y que su valor inicial es 2, ya que por formula es el primero que necesitamos, creamos tambien un segundo contador con el nombre $c2 y valor inicial cero y por ultimo creamos un acumulador de nombre $suma en el cual se guardara el total luego de multiplicar y sumar como manda la formula */
            while ($c2 < $ca) {
                $suma = $suma + ($r[$c2] * $m);
                if ($m == 7) {
                    $m = 2;
                } else {
                    $m++;
                }
                $c2++;
            }
            /* Hacemos un nuevo ciclo en el cual a $suma se le suma (valga la redundancia) su propio valor (que inicialmente es cero) más el resultado de la multiplicación entre el valor del array correspondiente por el multiplicador correspondiente, basandonos en la formula */
            $resto = $suma % 11;
            /* Calculamos el resto de la división usando el simbolo % */
            $digito = 11 - $resto;
            /* Calculamos el digito que corresponde al Rut, restando a 11 el resto obtenido anteriormente */
            if ($digito == 10) {
                $digito = 'K';
            } else {
                if ($digito == 11) {
                    $digito = '0';
                }
            }
            /* Creamos dos condiciones, la primero dice que si el valor de $digito es 11, lo reemplazamos por un cero (el cero va entre comillas. De no hacerlo así, el programa considerará “nada” como cero, es decir si la persona no ingresa Digito Verificado y este corresponde a un cero, lo tomará como valido, las comillas, al considerarlo texto, evitan eso). El segundo dice que si el valor de $digito es 10, lo reemplazamos por una K, de no cumplirse ninguno de las condiciones, el valor de $digito no cambiará. */
            if ($dv == $digito) {
                return number_format($rut,0,",",".") . '-' . $dv;
            }
            /* Por ultimo comprobamos si el resultado que obtuvimos es el mismo que ingreso la persona, de ser así se muestra el mensaje “Valido”, de no ser así se muestra el mensaje “No Valido” */
        }

        $this->set_message('rut', 'El campo %s no es válido.');
        return FALSE;
    }

    public function date($fecha) {
        if(!$fecha)
            return TRUE;
        
        $fecha = explode('-', $fecha);
        if (count($fecha) == 3) {

            if (checkdate($fecha[1], $fecha[2], $fecha[0])){
                return TRUE;
            }
        }
        
        $this->set_message('date', 'El campo %s no es una fecha válida.');
        return FALSE;
    }
    

    
    /* Funcion isUniqueEmail
    * Esta función es para validar que al editar un usuario no se utilice un email ya existente dentro de la base de usuarios
    */
    function isUniqueEmail($email,$usuario_id){
        $usuarios =  Doctrine::getTable('Usuario')->findAll();
        foreach($usuarios as $u){
            if($u->id != $usuario_id){
                if($u->email == $email){
                    $this->set_message('isUniqueEmail', 'El campo %s ya existe en la BD.');
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
    
    public function check_captcha($word,$ip){
        $expiration = time()-600;
         
        $query = Doctrine_Query::create()
        ->from('Captcha c')
        ->where('c.word = ? AND c.ip_address = ? AND c.captcha_time > ?', array($word,$ip,$expiration))
        ->count();
    
    
        if($query)
            return TRUE;
    
        $this->set_message('check_captcha', 'El valor ingresado en el campo <strong>%s</strong> no es correcto.');
        return FALSE;
    
    }

    public function valid_user($usuario){
        $query = Doctrine_Query::create()
        ->from('Usuario u')
        ->where('u.usuario = ?', $usuario)
        ->count();
    
        if ($query) //if user exists
            return TRUE;
    
        $this->set_message('valid_user', 'El usuario <strong>'.$usuario.'</strong> no existe en nuestra BD.');
        return FALSE;
    
    }
    
}
