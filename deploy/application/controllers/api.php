<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends My_Controller {

	public function index()
	{

	}
	
	public function ping($grow_id, $date_time, $hum, $temp, $version, $error, $luz, $riego )
	{
		$error			= 0;
		$currentVersion	= null;
		$programa		= null;

		$plantaLogModel		= new Planta_Log_model();
		$plantaConfigModel	= new Planta_Configuraciones_model();

		// Get la planta.
		$plantaConfigModel->grow_id = $grow_id;
		$plantaConfig = $plantaConfigModel->getConfig();
		
		if ( count($plantaConfig) )
		{
			$currentVersion = $plantaConfig[0]->version;

			if ( $currentVersion != $version )
			{
				$programa = $plantaConfigModel->generarPrograma();
			}
		}
		else
		{
			// [ERROR] No se encuentra la planta.
			$error			= 1;
		}
		
		// Json
		$jsonReturn = array(
						'error'			=> $error,
						'version'		=> $currentVersion,
						'programa'		=> $programa
					);

		$newLogId = $plantaLogModel->nuevoLog($grow_id, $date_time, $hum, $temp, $version, $error, $jsonReturn, $luz, $riego);

		if ( !$newLogId )
		{
			// No se pudo insertar el log.
			error_log('No se pudo guardar el log.');
		}

		echo json_encode( $jsonReturn );
	}
}
