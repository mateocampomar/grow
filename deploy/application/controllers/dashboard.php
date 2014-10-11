<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends My_Controller {

	public function index()
	{
		$data = array();

		$planta_model = new Planta_Configuraciones_model();
		$planta_model->grow_id = $this->isLogin->grow_id;
		$plantaObj = $planta_model->getConfig();

		$data['plantaObj']			= $plantaObj[0];

		$this->load->view('templates/head',		$data);
		$this->load->view('dashboard',			$data);
		$this->load->view('templates/footer',	$data);
	}

	public function flip_luz()
	{
		$data = array();
		
		$planta_model = new Planta_Configuraciones_model();
		$planta_model->grow_id = $this->isLogin->grow_id;
		$plantaObj = $planta_model->getConfig();
		$plantaObj = $plantaObj[0];

		// Form
		$porDiaOptions	= array();
		for($i=0 ; $i<=24*2 ; $i++)	$porDiaOptions[$i*30] = $i/2;		// El select mustra horas pero pasa el valor en minutos.
		$porDiaSelected	= ( $this->input->post('por_dia') ) ? $this->input->post('por_dia') : $plantaObj->luz_por_dia;

		list($hh, $mm) = explode( ":", $plantaObj->luz_hora_encendido );

		$horaHHOptions	= array();
		for($i=0 ; $i<=24 ; $i++)		$horaHHOptions[$i] = $i;
		$horaHHSelected	= ( $this->input->post('horaHH') ) ? $this->input->post('horaHH') : $hh;

		$horaMMOptions	= array();
		for($i=0 ; $i<=45 ; $i=$i+15)	$horaMMOptions[$i] = $i;
		$horaMMSelected	= ( $this->input->post('horaMM') ) ? $this->input->post('horaMM') : $mm;
		
		$this->form_validation->set_rules('por_dia',			'',		'required');

		// Submit
		if ($this->form_validation->run() == FALSE)
		{
			// Not ok
		}
		else
		{
			if ( $planta_model->editarLuz( $this->input->post('por_dia'), $this->input->post('horaHH'), $this->input->post('horaMM') ) )
			{
				// Genera una nueva versión del programa
				$planta_model->nuevaVersion();
			
				redirect(base_url( 'index.php/dashboard'), 'location');
			}
		}

		$data['porDiaOptions']		= $porDiaOptions;
		$data['porDiaSelected']		= $porDiaSelected;
		$data['horaHHOptions']		= $horaHHOptions;
		$data['horaHHSelected']		= $horaHHSelected;
		$data['horaMMOptions']		= $horaMMOptions;
		$data['horaMMSelected']		= $horaMMSelected;

		$this->load->view('dashboard_flip_luz',		$data);
	}

	public function flip_riego()
	{
		$data = array();
		
		$planta_model = new Planta_Configuraciones_model();
		$planta_model->grow_id = $this->isLogin->grow_id;
		$plantaObj = $planta_model->getConfig();
		$plantaObj = $plantaObj[0];

		// Form
		$porDiaOptions	= array();
		for($i=0 ; $i<=100; $i++)	$maxHumOptions[$i] = $i;
		$maxHumSelected	= ( $this->input->post('max_hum') ) ? $this->input->post('max_hum') : $plantaObj->max_hum;

		$porDiaOptions	= array();
		for($i=0 ; $i<=100; $i++)	$minHumOptions[$i] = $i;
		$minHumSelected	= ( $this->input->post('min_hum') ) ? $this->input->post('min_hum') : $plantaObj->min_hum;

		
		$this->form_validation->set_rules('max_hum',			'',		'required');
		$this->form_validation->set_rules('min_hum',			'',		'required');

		// Submit
		if ($this->form_validation->run() == FALSE)
		{
			// Not ok
		}
		else
		{
			if ( $planta_model->editarRiego( $this->input->post('max_hum'), $this->input->post('min_hum') ) )
			{
				// Genera una nueva versión del programa
				$planta_model->nuevaVersion();
			
				redirect(base_url( 'index.php/dashboard'), 'location');
			}
		}

		$data['maxHumOptions']		= $maxHumOptions;
		$data['maxHumSelected']		= $maxHumSelected;
		$data['minHumOptions']		= $minHumOptions;
		$data['minHumSelected']		= $minHumSelected;
		$data['plantaObj']			= $plantaObj;

		$this->load->view('dashboard_flip_riego',		$data);
	}
	
	public function chart()
	{
		$data = array();

		$plantaLogModel		= new Planta_Log_model();
		$plantaLogModel->grow_id = $this->isLogin->grow_id;
		$plantaLog = $plantaLogModel->getLog();
		
		$data['show_menu']		= false;
		$data['planta_log']		= $plantaLog;
	
		$this->load->view('templates/head',		$data);
		$this->load->view('dashboard_chart',	$data);
		$this->load->view('templates/footer',	$data);
	}
}
