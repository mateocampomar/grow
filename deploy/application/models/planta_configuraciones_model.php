<?php
class Planta_Configuraciones_model extends My_Model {

	public $grow_id	= null;

	public function nuevaPlanta( $grow_id )
	{
		$data = array(
			'grow_id'	=> $grow_id
		);
		
		$this->db->insert('planta_configuraciones', $data);
		
		return $this->db->insert_id();
	}

	public function getConfig()
	{
		$this->db->select('*, planta_configuraciones.version as version, planta_configuraciones.min_hum as min_hum, planta_configuraciones.max_hum as max_hum');
	
		$this->db->from('planta_configuraciones');
		
		$this->db->join('usuario',		'usuario.grow_id = planta_configuraciones.grow_id');
		$this->db->join('planta_log',	'planta_log.grow_id = usuario.grow_id', 'left');

		$this->db->where('planta_configuraciones.grow_id', $this->grow_id);
		
		$this->db->order_by('planta_log.fechaAuto', 'desc');
		
		$this->db->limit(1);

		$query = $this->db->get();
		
		$return = $query->result();
		
		return $return;
	}


	public function editarLuz( $por_dia, $hh, $mm )
	{
		$data = array(
			'luz_por_dia'			=> $por_dia,
			'luz_hora_encendido'	=> $hh . ":" . $mm . ":00",
		);

		$this->db->where('grow_id', $this->grow_id);

		$result = $this->db->update('planta_configuraciones', $data);
		
		return $result;
	}

	public function editarRiego( $max_hum, $min_hum )
	{
		$data = array(
			'max_hum'	=> $max_hum,
			'min_hum'	=> $min_hum,
		);

		$this->db->where('grow_id', $this->grow_id);

		$result = $this->db->update('planta_configuraciones', $data);
		
		return $result;
	}

	public function nuevaVersion()
	{
		$plantaConfig = $this->getConfig();
		$plantaConfig = $plantaConfig[0];
	
		$data = array(
			'version'			=> $plantaConfig->version + 1,
		);

		$this->db->where('grow_id', $this->grow_id);

		$result = $this->db->update('planta_configuraciones', $data);
		
		return $result;
	}
	
	public function generarPrograma()
	{
		$config = $this->getConfig();
		$config = $config[0];
		
		$returnArray = array();
		
		// Luz
		$luzArray = array(
							'tipo'			=> 'diario',
							'function'		=> 'luz',
							'iniciar'	=> $config->luz_hora_encendido,
							'params'		=> array(
													'tiempo'		=> $config->luz_por_dia
													),
							'desde'			=> null,
							'hasta'			=> null
						);
		$returnArray[]	= $luzArray;

		return $returnArray;
	}
}