<?php
class Planta_Log_model extends My_Model {

	public $grow_id;

	public function nuevoLog($grow_id, $date_time, $hum, $temp, $version, $error, $programa, $luz, $riego)
	{
		// Models
		$plantaConfigModel	= new Planta_Configuraciones_model();

		// Get la planta.
		$plantaConfigModel->grow_id = $grow_id;
		$plantaConfig = $plantaConfigModel->getConfig();
		$plantaConfig = $plantaConfig[0];

		$data = array(
			'grow_id'			=> $grow_id,
			'date_time'			=> $date_time,
			'fechaAuto'			=> date( 'Y-m-d H:i:s' ),
			'hum'				=> $hum,
			'temp'				=> $temp,
			'luz'				=> $luz,
			'riego'				=> $riego,
			'version'			=> $version,
			'error'				=> $error,
			'programa'			=> json_encode( $programa ),
			'max_hum'			=> $plantaConfig->max_hum,
			'min_hum'			=> $plantaConfig->min_hum,
			'remote_address'	=> $this->input->ip_address(),
		);

		$this->db->insert('planta_log', $data);

		return $this->db->insert_id();
	}
	
	public function getLog()
	{
		$this->db->select('*, AVG(hum) as avg_hum, AVG(temp) as avg_temp, AVG(max_hum) as avg_max_hum, AVG(min_hum) as avg_min_hum, SUM(luz) as sum_luz, SUM(riego) as sum_riego');
	
		$this->db->from('planta_log');

		if ( $this->grow_id )
		{
			$this->db->where('grow_id', $this->grow_id);
		}
		
		$this->db->order_by('fechaAuto', 'asc');
		
		$this->db->group_by('HOUR(fechaAuto)');

		$query = $this->db->get();
		
		$return = $query->result();
		
		return $return;
	}
}