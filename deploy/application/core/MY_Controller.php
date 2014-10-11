<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller
{

	protected $isLogin	= false;

    function __construct()
    {
		parent::__construct();
		
		if ( $this->session->userdata('login') )
		{
			$usuarioModel	= new Usuario_Model();
			
			$usuario = $usuarioModel->getById( $this->session->userdata('login') );

			$this->isLogin = $usuario;
		}
		
		// Seguridad. Sin login solo puede acceder al controlador de registro o api.
		if( $this->router->fetch_class() != 'registro' && $this->router->fetch_class() != 'api'  && !$this->isLogin )
		{
			redirect(base_url( 'index.php/registro/login'), 'location');
		}

		// Paso las variables al view.
        $this->load->vars(array(
        					'login'		=> $this->isLogin
        					));		
    }
}