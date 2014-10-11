<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends My_Controller {

	public function login()
	{
		$data = array();

		$data['form_email'] = array(
										'name'      	=> 'email',
										'value'			=> $this->input->post('email'),
										'autocomplete'	=> 'off',
										'class'			=> 'big',
										'placeholder'	=> 'email'
		);

		$data['form_password'] = array(
										'name'      	=> 'password',
										'type'			=> 'password',
										'value'			=> $this->input->post('password'),
										'autocomplete'	=> 'off',
										'class'			=> 'big',
										'placeholder'	=> 'contraseña'
		);


		// Validaciones
		$this->form_validation->set_rules('password',			'',		'required');
		$this->form_validation->set_rules('email',				'',		'required|valid_email');


		// Submit
		if ($this->form_validation->run() == FALSE)
		{
			// Not ok
		}
		else
		{
			$usuarioModel	= new Usuario_Model();
			
			$usuario = $usuarioModel->login(
										$this->input->post('email'),
										$this->input->post('password')
									);
									
			if ( count($usuario) )
			{			
				$this->session->set_userdata( 'login', $usuario[0]->id );

				redirect(base_url( 'index.php/dashboard'), 'location');
			}
			else
			{
				$invalidLogin = true;
			}
		}


		$data['show_menu']		= false;
		$data['invalidLogin']	= ( isset($invalidLogin) && $invalidLogin ) ? true : false;

		$this->load->view('templates/head',		$data);
		$this->load->view('login',				$data);
		$this->load->view('templates/footer',	$data);
	}
	
	public function logout()
	{
		$this->session->set_userdata( 'login', false );

		redirect(base_url( 'index.php/registro/login'), 'location');
	}

	public function signup()
	{
		$data = array();

		$data['form_nombre'] = array(
										'name'      	=> 'nombre',
										'value'			=> $this->input->post('nombre'),
										'autocomplete'	=> 'off',
										'class'			=> 'big',
										'placeholder'	=> 'nombre de la planta'
		);

		$data['form_email'] = array(
										'name'      	=> 'email',
										'value'			=> $this->input->post('email'),
										'autocomplete'	=> 'off',
										'class'			=> 'big',
										'placeholder'	=> 'email'
		);

		$data['form_password'] = array(
										'name'      	=> 'password',
										'type'			=> 'password',
										'value'			=> $this->input->post('password'),
										'autocomplete'	=> 'off',
										'class'			=> 'big',
										'placeholder'	=> 'contraseña'
		);

		$data['form_grow_id'] = array(
										'name'      	=> 'grow_id',
										'value'			=> $this->input->post('grow_id'),
										'autocomplete'	=> 'off',
										'class'			=> 'big',
										'placeholder'	=> 'Grow id'
		);
		
		// Validaciones
		$this->form_validation->set_rules('nombre',				'',		'required');
		$this->form_validation->set_rules('email',				'',		'required|valid_email|is_unique[usuario.email]');
		$this->form_validation->set_rules('password',			'',		'required');
		$this->form_validation->set_rules('grow_id',			'',		'required|is_unique[usuario.grow_id]');		


		// Submit
		if ($this->form_validation->run() == FALSE)
		{
			// Not ok
		}
		else
		{
			$usuarioModel	= new Usuario_Model();
			$planta_model	= new Planta_Configuraciones_model();
			
			$usuarioModel->nuevoUsuario(
										$this->input->post('nombre'),
										$this->input->post('email'),
										$this->input->post('password'),
										$this->input->post('grow_id')
									);
			
			$planta_model->nuevaPlanta(
										$this->input->post('grow_id')
									);
			
			redirect(base_url( 'index.php/registro/login'), 'location');
		}
		
		$data['show_menu']		= false;

		$this->load->view('templates/head',		$data);
		$this->load->view('registro',			$data);
		$this->load->view('templates/footer',	$data);
	}
}
