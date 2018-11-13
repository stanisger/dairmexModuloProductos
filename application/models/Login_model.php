<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login_user($email,$password)
	{
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get('users');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			redirect(base_url().'Login','refresh');
		}
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

	public function get_user($id_usuario)
	{
		$this->db->where('id',$id_usuario);
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
	public function edit_user($id,$nombre,$apaterno,$empresa,$telefono,$email)
	{

		$fecha = date('Y-m-d');

		$perf = array(1=>'administrador',2=>'suscriptor');

		$data = array(		
			'nombre'		=>	$nombre,
			'apaterno'		=>  $apaterno,
			'empresa'		=>  $empresa,
			'telefono'		=>  $telefono,
			'email'			=>  $email,
			'username'		=>  $nombre,			
			'registro'		=>	$fecha

		);

		$this->db->where('id',$id);
		if($this->db->update('users',$data)){
			return TRUE;
		}else{
			return FALSE;
		}

	}

	public function password_user($id,$password){
		
		$data = array(		
			'password'		=>	$password
		);

		$this->db->where('id',$id);
		if($this->db->update('users',$data)){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	//añadimos usuarios
	public function new_user($perfil,$nombre,$apaterno,$empresa,$telefono,$email,$password)
	{

		$fecha = date('Y-m-d');

		$perf = array(1=>'administrador',2=>'suscriptor');

		$data = array(
			'perfil'		=>	$perf[$perfil],
			'nombre'		=>	$nombre,
			'apaterno'		=>  $apaterno,
			'empresa'		=>  $empresa,
			'telefono'		=>  $telefono,
			'email'			=>  $email,
			'username'		=>  $nombre,
			'password'		=>  $password,
			'registro'		=>	$fecha,
			'activo'		=>  1

		);

		if($this->db->insert('users',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}