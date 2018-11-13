<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Crud_model extends CI_MODEL
{
	public function __construct()
	{

		parent::__construct();

	}

	//obtenemos los usuarios
	public function get_users()
	{

		$query = $this->db->get('users');
		if($query->num_rows() > 0)
		{

			return $query->result();

		}

	}

	//eliminamos usuarios
	public function delete_user($id)
	{

		$this->db->where('id',$id);
		return $this->db->delete('users');

	}

	//editamos usuarios
	public function edit_user($id,$nombre,$email)
	{

		$fecha = date('Y-m-d');

		$data = array(

			'nombre'	=>		$nombre,
			'email'		=>		$email,
			'registro'	=>		$fecha

		);

		$this->db->where('id',$id);
		$this->db->update('users',$data);

	}

	//añadimos usuarios
	public function new_user($nombre,$email)
	{

		$fecha = date('Y-m-d');

		$data = array(

			'nombre'	=>		$nombre,
			'email'		=>		$email,
			'registro'	=>		$fecha

		);

		$this->db->insert('users',$data);

	}

}

/*
*Location: application/models/crud_model.php
*/