<?php
class Usuario_model extends My_Model {

	public function nuevoUsuario($nombre, $email, $password, $grow_id)
	{
		$data = array(
			'nombre'		=> $nombre,
			'email'			=> $email,
			'fechaAuto'		=> date( 'Y-m-d H:i:s' ),
			'password'		=> $password,
			'grow_id'		=> $grow_id
		);

		$this->db->insert('usuario', $data);

		return $this->db->insert_id();
	}
	
	public function login($email, $password)
	{
		$this->db->select();
	
		$this->db->from('usuario');

		$this->db->where('email', $email);
		$this->db->where('password', $password);

		$query = $this->db->get();
		
		$return = $query->result();
		
		return $return;
	}
	
	public function getById( $id )
	{
		$this->db->select();
	
		$this->db->from('usuario');

		$this->db->where('id', $id);

		$query = $this->db->get();
		
		$return = $query->result();
		
		return ( count($return) ) ? $return[0] : false;
	}
}